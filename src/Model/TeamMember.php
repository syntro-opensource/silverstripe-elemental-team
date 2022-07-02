<?php

namespace Syntro\SilverstripeElementalTeam\Model;

use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use Syntro\SilverStripeElementalBaseitem\Model\BaseItem;
use Syntro\SilverstripeElementalTeam\Element\Team;

/**
 * represents a team Member
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class TeamMember extends BaseItem
{
    /**
     * Defines the database table name
     * @config
     * @var string
     */
    private static $table_name = 'ElementTeamTeamMember';

    /**
     * We do not allow the title (Name to be toggled)
     * @config
     * @var bool
     */
    private static $displays_title_in_template = false;

    /**
     * @config
     * @var array
     */
    private static $db = [
        'Position' => 'Varchar',
        'Description' => 'Text'
    ];

    /**
     * @config
     * @var array
     */
    private static $has_one = [
        'Portrait' => Image::class,
        'Section' => Team::class,
    ];

    /**
     * Relationship version ownership
     * @config
     * @var array
     */
    private static $owns = [
        'Portrait'
    ];

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @config
     * @var array
     */
    private static $summary_fields = [
        'Title' => 'Name',
        'Position' => 'Position'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'SectionID'
        ]);
        $fields->fieldByName('Root.Main.Title')->setTitle(_t(__CLASS__ . '.NAMETITLE', 'Name'));
        $fields->addFieldToTab(
            'Root.Main',
            $portraitField = UploadField::create(
                'Portrait',
                _t(__CLASS__ . '.PORTRAITTITLE', 'Portrait')
            ),
            'Title'
        );
        $fields->addFieldsToTab(
            'Root.Main',
            [
                $positionField = TextField::create(
                    'Position',
                    _t(__CLASS__ . '.POSITIONTITLE', 'Position')
                ),
                $descriptionField = TextareaField::create(
                    'Description',
                    _t(__CLASS__ . '.DESCRIPTIONTTITLE', 'Description')
                ),
            ]
        );
        $portraitField
            ->setFolderName('Team')
            ->setAllowedMaxFileNumber(1);
        return $fields;
    }
}
