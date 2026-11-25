# Adaptation Notes

Copy `files/PlugininfoField.php` and edit the copy in place. Preserve the information panel, version badge and WebTolk branding. Keep changes limited to the target plugin's namespace, form configuration, details and language keys.

1. Read `<namespace path="...">` in the target plugin manifest. Use its exact namespace as the PSR-4 base and append the field file's directory relative to `path`, with backslashes between segments. Reuse the plugin's existing field directory and match its casing. For example, with `<namespace path="src">Vendor\Plugin\System\Example</namespace>` and `src/Fields/PlugininfoField.php`, replace `__JOOMLA_PLUGIN_FIELD_NAMESPACE__` with `Vendor\Plugin\System\Example\Fields`.
2. In the target plugin manifest `<element>.xml`, find `<config>` and its `<fields name="params">`. Add the field inside the existing settings `<fieldset>` where the panel should appear. Use `type="plugininfo"` and set `addfieldprefix` to the same namespace declared in `PlugininfoField.php`. Make sure `<files>` includes the source directory, for example `<folder>src</folder>`.

   ```xml
   <config>
       <fields name="params">
           <fieldset name="basic">
               <field name="plugin_info" type="plugininfo" addfieldprefix="Vendor\Plugin\System\Example\Fields" />
           </fieldset>
       </fields>
   </config>
   ```

3. Use this field in the settings form of an installed plugin. The bound form data must contain `folder` and `element`. The version badge reads `<version>` from `plugins/<folder>/<element>/<element>.xml`.
4. Verify the description key is present in the plugin's loaded language files. The template looks up `PLG_<ELEMENT>_DESC`, such as `PLG_EXAMPLE_DESC`. When the prefix contains `{group}`, the class must include the group from `$folder` along with `$element` in the lookup in `getInput()`. Keep the suffix used by the actual language file. For example, `Text::_('PLG_' . strtoupper($folder . '_' . $element) . '_XML_DESCRIPTION')` looks up `PLG_SYSTEM_EXAMPLE_XML_DESCRIPTION` for the `system` group and `example` element.
5. Replace `@subpackage` with the target plugin's Joomla element. Keep `@version __DEPLOY_VERSION__` for the build tool to substitute the release version. Resolve `@since __SINCE_VERSION__` separately to the version that introduced the code.
6. Check the API against the relevant `joomla.core.source.5` or `joomla.core.source.6` resources in PF. Use supported Joomla 5 and 6 APIs and exclude deprecated classes and methods.
7. Compare the adapted file with the template, run `php -l` and review the plugin settings form. Verify the logo, version and translated description in the target locales. Check that the logo fills its column below `lg` and scales inside the narrower desktop columns, including `xxl`.

[Joomla custom field registration](https://manual.joomla.org/docs/5.4/general-concepts/forms-fields/custom-fields-overview/)
