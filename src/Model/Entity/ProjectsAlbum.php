<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectsAlbum Entity
 *
 * @property int $id
 * @property string $project_id
 * @property string $album_id
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Album $album
 */
class ProjectsAlbum extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
