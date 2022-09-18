Google Tag Manager
==================
The Bolt extension automatically adds the code snippets needed to run Tag Manager on your site.

To get it set up, create a Container ID on [Google Tag Manager](https://tagmanager.google.com/) website, then add it extension config file. The extension will do the rest.

Snippets can be added to the frontend and/or backend using the configuration file.

Read more about [setting up Tag Manager](https://support.google.com/tagmanager/answer/6103696?hl=en).


Enabling
--------

To enable Google Tag Manager include the following config to `config/extensions/charpand-googletagmanager.yaml` or `config/extensions/charpand-googletagmanager_local.yaml`

```yaml
# The Container ID looks like 'GTM-XXXXX'.
google_tag_manager: ''

# If you don't already include bootstrap, also add the next line, otherwise leave it out! 
auto_provide_bootstrap: true
```