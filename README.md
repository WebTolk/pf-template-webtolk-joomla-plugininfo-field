# WebTolk Joomla Plugininfo Field for ProcessForge

This ProcessForge template package provides the WebTolk-branded `plugininfo` field for a Joomla 5 or 6 plugin settings form. It displays the plugin version from its installed XML manifest and a translated description in a read-only information panel.

[Plugininfo field](files/PlugininfoField.php) ? [WebTolk](https://web-tolk.ru/) ? [Process Forge](https://processforge.ru/)

## Adapt the template

Copy `files/PlugininfoField.php` into the plugin's field directory, for example `src/Fields/PlugininfoField.php`. Derive its PHP namespace from the plugin manifest's `<namespace path="...">` and the directories below that path. In the same manifest, register the field in the existing settings fieldset under `<config><fields name="params">` with `type="plugininfo"` and the matching `addfieldprefix`.

The form supplies `folder` and `element`. The field uses them to read the installed manifest and looks up `PLG_<ELEMENT>_DESC`. When the target language prefix contains `{group}`, include the group from `$folder` as well as `$element` in the class's translation key. [Adaptation steps](prompts/adaptation-notes.md)

## Install into ProcessForge

The package ID is `joomla-plugininfo-field` and its manifest type is `reusable_template`. Share the [latest stable release](https://github.com/WebTolk/pf-template-webtolk-joomla-plugininfo-field/releases/latest) with the agent installing it.

1. Download the versioned `joomla-plugininfo-field-<version>.zip` and its [update manifest](https://github.com/WebTolk/pf-template-webtolk-joomla-plugininfo-field/releases/latest/download/update-manifest.json). Select the version of the `joomla-plugininfo-field` subject that matches the ZIP and verify the ZIP against its `sha256`.
2. Resolve the destination with `python "<pf-root>/bin/pf.py" path-resolve --workplace "<workplace>" --path '${PF_TEMPLATES}/joomla-plugininfo-field'`. For a first installation, extract the ZIP there with `template.yaml` at the destination root. For an existing registered installation, use the ProcessForge update flow.
3. Merge the template entry into `<workplace>/registries/templates.yaml`. Reuse the existing root ID for `${PF_TEMPLATES}` or add a root for it. Set the entry's `path` to the extracted manifest's actual path relative to the workplace, using the local resolved path if the configured root is outside the workplace.

The following entries use the default workplace path. Keep the other registry entries when merging them.

```yaml
template_roots:
  - id: global
    label: Workplace reusable templates
    path: '${PF_TEMPLATES}'
    scope: workplace
    status: available
templates:
  - id: joomla-plugininfo-field
    title: WebTolk Joomla Plugininfo field
    kind: scaffold
    root_id: global
    template_root: global
    path: reusable-templates/joomla-plugininfo-field/template.yaml
    status: available
```

Verify template discovery and register its declared update source with ProcessForge.

```sh
python "<pf-root>/bin/pf.py" template-doctor --workplace "<workplace>" --template joomla-plugininfo-field
python "<pf-root>/bin/pf.py" update entity-sources rebuild --workplace "<workplace>"
```

See the [changelog](https://github.com/WebTolk/pf-template-webtolk-joomla-plugininfo-field/blob/main/CHANGELOG.md) for release changes.

The template is distributed under the [GNU General Public License version 3 or later](LICENSE).
