# Repairable Base Magento 2 module

## Repairable widget for your own Magento 2 project.

The module will help you easily set up the Repairable widget on your Magento 2 site.

###### Developed and tested on PHP 8.1 version.

##### Key Features:

- The ability to easily display a GUI for a Repairable form.
- Configuration from Magento 2 admin.

### Installation.

```code
composer require dized/module-repairable-base
```

### Adding Repairable form to the Magento 2 project.

To add the Repairable form to the project you have to have special **Public Key** and **Private Key** values.

The keys you can receive from the Repairable support.

Once you have received it, you must enter the data in the Magento 2 configuration in the admin area.

Please, do it here: **Admin Panel -> Stores -> Settings -> Configuration -> DiZed Team Extensions -> Repairable**.

### Three ways to display the Repairable form on a Magento 2 website.

- In the admin panel through the CMS block. You need to create or update a CMS block by adding a special code to the text. Please, do it here: **Admin Panel -> Content -> Elements -> Blocks**.

```text
{{block class="DiZed\RepairableBase\Block\Form\Widget" block_id="RepairableWidgetForm"}}
```

- Programmatically to XML layout.

```xml
<referenceContainer name="content">
    <block class="DiZed\RepairableBase\Block\Form\Widget"
           name="repairable.widget.form"
           template="DiZed_RepairableBase::form/widget.phtml"/>
</referenceContainer>
```

```text
php bin/magento cache:clean layout block_html full_page
```

- Programmatically into the template via PHP code.

```php
<?= /* @noEscape */ echo $this->getLayout()
    ->createBlock(\DiZed\RepairableBase\Block\Form\Widget::class)
    ->toHtml() ?>
```

```text
php bin/magento cache:clean layout block_html full_page
```
