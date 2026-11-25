# Adaptation Notes

Copy `files/PlugininfoField.php` and edit the copy in place. Preserve the information panel, version badge and WebTolk branding. Keep changes limited to the target plugin's namespace, form configuration, details and language keys.

1. Put `PlugininfoField.php` in the plugin's existing field directory, for example `src/Fields/PlugininfoField.php`. Replace `__JOOMLA_PLUGIN_FIELD_NAMESPACE__` with its actual PSR-4 namespace.
2. Add the field inside the plugin manifest's administrator settings fieldset. Set `type="plugininfo"` and use the actual field namespace in `addfieldprefix`.

   ```xml
   <field name="plugin_info" type="plugininfo" addfieldprefix="Vendor\Plugin\System\Example\Fields" />
   ```

3. Use this field in the settings form of an installed plugin. The bound form data must contain `folder` and `element`. The version badge reads `<version>` from `plugins/<folder>/<element>/<element>.xml`.
4. Verify the description key is present in the plugin's loaded language files. The template looks up `PLG_<ELEMENT>_DESC`, such as `PLG_EXAMPLE_DESC`. When the prefix contains `{group}`, the class must include the group from `$folder` along with `$element` in the lookup in `getInput()`. Keep the suffix used by the actual language file. For example, `Text::_('PLG_' . strtoupper($folder . '_' . $element) . '_XML_DESCRIPTION')` looks up `PLG_SYSTEM_EXAMPLE_XML_DESCRIPTION` for the `system` group and `example` element.
5. Replace `@subpackage` with the target plugin's Joomla element. Keep `@version __DEPLOY_VERSION__` for the build tool to substitute the release version. Resolve `@since __SINCE_VERSION__` separately to the version that introduced the code.
6. Check the API against the relevant `joomla.core.source.5` or `joomla.core.source.6` resources in PF. Use supported Joomla 5 and 6 APIs and exclude deprecated classes and methods.
7. Compare the adapted file with the template, run `php -l` and review the plugin settings form. Verify the logo, version and translated description in the target locales.

[Joomla custom field registration](https://manual.joomla.org/docs/5.4/general-concepts/forms-fields/custom-fields-overview/)
