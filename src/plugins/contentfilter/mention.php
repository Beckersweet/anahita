<?php 

/** 
 * LICENSE: ##LICENSE##
 * 
 * @category   Anahita
 * @package    Plg_Contentfilter
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc.
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.GetAnahita.com
 */

/**
 * Converts @username terms to links
 * 
 * @category   Anahita
 * @package    Plg_Contentfilter
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.GetAnahita.com
 */
class PlgContentfilterMention extends PlgContentfilterAbstract
{       
	/**
     * Initializes the default configuration for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     * 
     * @return void
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'priority'   => KCommand::PRIORITY_LOW,
        ));

        parent::_initialize($config);
    }
	
	/**
	 * Filter a value  
	 * 
	 * @param string The text to filter
	 * 
	 * @return string
	 */
	public function filter($text)
	{
		$this->_stripTags($text);
        
		$matches = array();
		
		$text = preg_replace(
			ComPeopleDomainEntityPerson::PATTERN_MENTION, 
			'<a class="mention" href="'.JRoute::_("option=com_people&view=person&uniqueAlias=$2").'">$0</a>', 
			$text);
			
		$this->_replaceTags($text);	
		
		return $text;
	}
}