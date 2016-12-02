<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Album Entity
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property bool $sfw
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $user_id
 * @property string $language_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\Act[] $acts
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Project[] $projects
 */
class Album extends Entity
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
