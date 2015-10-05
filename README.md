# angsym-forms

Symfony2 bundle to expose forms for Angular.js interface and process AJAX submits.

# Usage

## Controller
```php
/**
 * @Route("/")
 * @Template()
 */
public function indexAction()
{
    return [
        'formName' => Form1::class
    ];
}

/**
 * @Route("/test-form-1", name="test_form1")
 * @Template()
 */
public function testForm1Action(Request $request)
{
    $response = $this->get('angsym.form')->processForm($request, Form1::class, TestEntity::class);

    return $response;
}
```
    
## Twig

```html
{{ angsym_form('myAppTest', formName, path("test_form1"), 'POST' ) }}
```