<?php

namespace Syntro\SilverstripeElementalTeam\Element;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Assets\File;
use SilverStripe\ORM\ValidationResult;
use DNADesign\Elemental\Models\BaseElement;
use Syntro\SilverStripeElementalBaseitem\Forms\GridFieldConfig_ElementalChildren;
use Syntro\SilverstripeElementalTeam\Model\TeamMember;

/**
 * allows to create a team section, listing team Members
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class Team extends BaseElement
{

    /**
     * Defines the database table name
     * @config
     *  @var string
     */
    private static $table_name = 'ElementTeam';

    /**
    * @config
     * @var string
     */
    private static $icon = 'font-icon-block-users';

    /**
     * Singular name for CMS
     * @config
     *  @var string
     */
    private static $singular_name = 'Team Section';

    /**
     * Plural name for CMS
     * @config
     *  @var string
     */
    private static $plural_name = 'Team Sections';

    /**
    * @config
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @config
     * @var bool
     */
    private static $allow_title_customization = false;

    /**
     * Display a show title button
     *
     * @config
     * @var boolean
     */
    private static $displays_title_in_template = false;

    /**
     * hide the fields using display logic
     *
     * @config
     * @var array
     */
    private static $hide_field_for_style = [];


    /**
     * Database fields
     * @config
     * @var array
     */
    private static $db = [
    ];

    /**
     * Add default values to database
     * @config
     *  @var array
     */
    private static $defaults = [
    ];

    /**
     * Has_one relationship
     * @config
     * @var array
     */
    private static $has_one = [
    ];

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'TeamMembers' => TeamMember::class,
    ];

    /**
     * Relationship version ownership
     * @config
     * @var array
     */
    private static $owns = [
        'TeamMembers'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        if ($this->ID) {
            /** @var GridField $griditems */
            $griditems = $fields->fieldByName('Root.TeamMembers.TeamMembers');
            $griditems->setConfig(GridFieldConfig_ElementalChildren::create());
            $fields->removeByName([
                'TeamMembers',
                'Root.TeamMembers.TeamMembers'
            ]);
            $fields->addFieldToTab(
                'Root.Main',
                $griditems
            );
        } else {
            $fields->removeByName([
                'TeamMembers',
                'Root.TeamMembers.TeamMembers'
            ]);
        }
        return $fields;
    }


    /**
     * getType
     *
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Team');
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = 'Team Section';
        return $blockSchema;
    }

    /**
     * validate - validates the given Data
     *
     * @return ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();
        return $result;
    }

}
