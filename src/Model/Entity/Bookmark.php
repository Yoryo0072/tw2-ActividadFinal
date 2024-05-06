<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bookmark Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $url
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Tag[] $tags
 */
class Bookmark extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    // Matriz que define los campos accesibles de la entidad Bookmark para operaciones de guardado.
    protected $_accessible = [
        'user_id' => true,
        'title' => true,
        'description' => true,
        'url' => true,
        'user' => true,
        'tags' => true,
        'tag_string' => true,
    ];

    // Método para obtener una cadena de etiquetas formateada
    protected function _getTagString()
    {
        // Comprueba si el campo tag_string ya está configurado en la entidad actual.
        // Si está configurado, devuelve el valor almacenado en el campo.
        // Esto evita la necesidad de volver a calcular la cadena de etiquetas si ya está disponible.
        if (isset($this->_fields['tag_string'])) {
            return $this->_fields['tag_string'];
        }

        // Si no hay etiquetas asociadas con la entidad, devuelve una cadena vacía.
        if (empty($this->tags)) {
            return '';
        }

        // Si hay etiquetas asociadas con la entidad, las procesa y las formatea en una cadena separada por comas.
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            // Agrega el título de cada etiqueta seguido de una coma y un espacio a la cadena final.
            return $string . $tag->title . ', ';
        }, '');

        // Elimina la última coma y el espacio en blanco de la cadena final antes de devolverla.
        return trim($str, ', ');
    }

    // Método beforeSave() para procesar la cadena de etiquetas antes de guardarla
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    // Método para construir las entidades de etiquetas relacionadas
    protected function _buildTags($tagString)
    {
        // Se eliminan los espacios en blanco alrededor de las etiquetas y se dividen por comas
        $newTags = array_map('trim', explode(',', $tagString));
        // Se eliminan las etiquetas vacías
        $newTags = array_filter($newTags);
        // Se eliminan las etiquetas duplicadas
        $newTags = array_unique($newTags);

        $out = [];
        // Se buscan las etiquetas existentes en la base de datos
        $tags = $this->Tags->find()
            ->where(['Tags.title IN' => $newTags])->all();

        // Se eliminan las etiquetas existentes de la lista de nuevas etiquetas
        foreach ($tags->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        // Se agregan las etiquetas existentes
        foreach ($tags as $tag) {
            $out[] = $tag;
        }
        // Se crean las nuevas etiquetas
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }
        return $out;
    }
}
