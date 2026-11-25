<?php

/**
 * Displays WebTolk plugin information in the Joomla administrator form.
 * @package       Package name is replaced by Phing from package.config.json
 * @subpackage    Replace with Joomla element before copying
 * @author        Author is replaced by Phing from package.config.json
 * @copyright     Copyright is replaced by Phing from package.config.json
 * @version       __DEPLOY_VERSION__
 * @since         __SINCE_VERSION__
 * @license       GNU General Public License version 3 or later.
 * @link          Link is replaced by Phing from package.config.json
 */

namespace __JOOMLA_PLUGIN_FIELD_NAMESPACE__;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\NoteField;
use Joomla\CMS\Language\Text;

class PlugininfoField extends NoteField
{
    protected $type = 'Plugininfo';

    /**
     * Render the plugin version and translated description.
     *
     * @return  string  The field input markup.
     *
     * @since   __SINCE_VERSION__
     */
    protected function getInput()
    {

        $data    = $this->form->getData();
        $element = $data->get('element');
        $folder  = $data->get('folder');
        $wa      = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->addInlineStyle("
			.plugin-info-img-svg:hover * {
				cursor:pointer;
			}

			@media (min-width: 1400px) {
				.plugin-info-img-svg {
					max-width: 160px;
				}
			}
		");

        $wt_plugin_info = simplexml_load_file(JPATH_SITE . "/plugins/" . $folder . "/" . $element . "/" . $element . ".xml");


        return $html = '</div><div class="shadow p-3 p-lg-4">
			<div class="row g-3 align-items-center">
				<div class="col-12 col-lg-4 col-xl-3 col-xxl-2">
					<a class="d-block" href="https://web-tolk.ru" target="_blank">
						<svg class="plugin-info-img-svg d-block w-100 h-auto" viewBox="0 0 150 50" xmlns="http://www.w3.org/2000/svg">
							<g>
								<title>Go to https://web-tolk.ru</title>
								<text font-weight="bold" xml:space="preserve" text-anchor="start"
								      font-family="Helvetica, Arial, sans-serif" font-size="32" id="svg_3" y="36.085949"
								      x="8.152073" stroke-opacity="null" stroke-width="0" stroke="#000"
								      fill="#0fa2e6">Web</text>
								<text font-weight="bold" xml:space="preserve" text-anchor="start"
								      font-family="Helvetica, Arial, sans-serif" font-size="32" id="svg_4" y="36.081862"
								      x="74.239105" stroke-opacity="null" stroke-width="0" stroke="#000"
								      fill="#384148">Tolk</text>
							</g>
						</svg>
					</a>
				</div>
				<div class="col-12 col-lg-8 col-xl-9 col-xxl-10">
					<span class="badge bg-success text-white">v.' . $wt_plugin_info->version . '</span>
					' . Text::_('PLG_'.strtoupper($element).'_DESC') . '
				</div>
			</div>
		</div><div>';
    }

    /**
     * @return  string  The field label markup.
     *
     * @since   __SINCE_VERSION__
     */
    protected function getLabel()
    {

        return ' ';

    }

    /**
     * Method to get the field title.
     *
     * @return  string  The field title.
     *
     * @since   __SINCE_VERSION__
     */
    protected function getTitle()
    {
        return $this->getLabel();
    }
}
