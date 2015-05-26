IbrowsXeditableBundle - VERIFICATION
=============================

x-editable ( http://vitalets.github.io/x-editable/ ) symfony2 forms integration


Install & setup the bundle
--------------------------

1. Add IbrowsXeditableBundle in your composer.json:

	```js
	{
	    "require": {
	        "ibrows/xeditable-bundle": "~1.0",
	    }
	}
	```

2. Now tell composer to download the bundle by running the command:

    ``` bash
    $ php composer.phar update ibrows/xeditable-bundle
    ```

    Composer will install the bundle to your project's `ibrows/xeditable-bundle` directory. ( PSR-4 )

3. Add the bundles to your `AppKernel` class

    ``` php
    // app/AppKernerl.php
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Ibrows\XeditableBundle\IbrowsXeditableBundle(),
            // ...
        );
        // ...
    }
    ```

4. Include JS-Lib and CSS Files

    ```
            {% javascripts
                '@IbrowsXeditableBundle/Resources/public/javascript/bootstrap.editable-1.5.1.js'
                '@IbrowsXeditableBundle/Resources/public/javascript/xeditable.js'
            %}
                <script type="text/javascript" src="{{ asset_url }}"></script>
            {% endjavascripts %}
    ```



    ```
            {% stylesheets
                'bundles/ibrowsxeditable/css/bootstrap-editable.css'
            %}
                <link rel="stylesheet" type="text/css" media="screen" href="{{ asset_url }}" />
            {% endstylesheets %}
    ```
    
Example
--------------------------
The current usage for this bundle is to display a whole form inside of x-editable. The HTML output of the render function 
is as follows - 
    
    ```
            <a 
             data-form="<div id=&quot;form_name&quot;><div>                <label for=&quot;form_name_test&quot;>Test</label><input type=&quot;text&quot; id=&quot;form_name_test&quot; name=&quot;form_name[form_name][test]&quot; maxlength=&quot;5&quot; value=&quot;test&quot; /></div><div>"
             aria-describedby="popover522525" 
             title="" 
             data-original-title="" 
             href="#" 
             class="ibrowsXeditable editable editable-click editable-empty editable-open" 
             data-xeditable="" 
             data-path="" 
             data-url="test" 
             data-type="ibrows_xeditable_form" 
             id="xeditable_ics_prodcavebundle_caves_">Empty</a>
    ```

Rendering the form is as easy as - 
    
    ```
        $form = $this->get('ibrows_xeditable.mapper.factory')->createForm('test', new TestType(), $entity, array(
                    'em' => $this->getDoctrine()->getEntityManager('test'),
                    'action' => $this->generateUrl('caves_update', array('id' => $entity->id())),
                    'method' => 'PUT',
                ));
    ```
    
Render the form with the built in TWIG function
    
    ```
        {{ xedit_inline_render(form) }}
    ```
        
Add the following JS to the page
    
    ```
        $("#xeditable_test").ibrowsXeditableInit()
    ```            
