# Photo Images Plugin

The **Photo Images** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Grav Plugin - Applies photograph "printed" effect to images (frame, shadow and rotation) via [ultrix3x/JQueryPhotoImages](http://github.com/ultrix3x/JQueryPhotoImages)

## Installation

Installing the Photo Images plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install photoimages

This will install the Photo Images plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/photoimages`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `photoimages`. You can find these files on [GitHub](https://github.com/jleaders/grav-plugin-photoimages) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/photoimages
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/jleaders/grav-plugin-photoimages/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/photoimages/photoimages.yaml` to `user/config/plugins/photoimages.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the Admin Plugin, a file with your configuration named photoimages.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

Simply add the `frame-tilt` CSS class to an image, i.e.:

    ![alt text](myimage.jpg?classes=frame-tilt)
    
or

    <img src='mypage/myimage.jpg' class='frame-tilt'>

You can control the parameters like this:

	<script>
	    jQuery(document).ready(function() {
		// Create photoImages with a seed-based rotation
		jQuery('.my-frame-tilt').photoImages({
		    boxShadowOffsetX: '10px',
		    boxShadowOffsetY: '10px',
		    boxShadowLength: '10px',
		    boxShadowColor: '#7f7f7f',
		    marginRight: '10px',
		    rotate: 'seed'
		});
	    });
	</script>
	
Then use `my-frame-tilt` class

## Credits

* Grav plugin by Jonathan Leaders
* Original photo image code by [ultrix3x/JQueryPhotoImages](http://github.com/ultrix3x/JQueryPhotoImages)

## To Do

- [ ] Upgrade functionality to support a firstclass parameter which sets the degrees of rotation ?framerot=15 

