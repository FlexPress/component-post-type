# FlexPress PostType component

## Install with Pimple
The PostType component uses two classes:
- AbstractPostType, which you extend to create a PostType.
- PostTypeHelper, which hooks into everything for you and registers the post types.

Lets create a pimple config for both of these

```
$pimple["documentPostType"] = function () {
  return new Document();
};

$pimple['PostTypeHelper'] = function ($c) {
    return new PostTypeHelper($c['objectStorage'], array(
        $c["documentPostType"]
    ));
};
```
- Note the dependency $c['objectStorage']  is a SPLObjectStorage

## Creating a concreate PostType class
Create a concreate class that implements the AbstractPostType class and implements the getName() method.

```
class DocumentType extends AbstractPostType {

    public function getName()
    {
      return "document";
    }
    
}
```
This above example is the bare minimum you must implement, the example that follows is the other extreme implementing all available methods.
```
class Document extends AbstractPostType {

  public function getSingularName()
  {
    return "Doc";
  }
  
  public function getPluralName()
  {
    return "Docs";
  }
  
  public function getArgs()
  {
    $args = parent::getArgs();
    $args['supports'] = array("title", "editor");
    return $args;
  }
  
  protected function getLabels()
  {
    $labels = parent::getLabels();
    $labels['menu_name'] = 'Docs';
    return $labels;
  }
    
  public function getName()
  {
    return "document";
  }

}
```

### Public Methods
- getSingularName() - returns the singular name of the post type.
- getPluralName() - returns the plural name of the post type.
- getArgs() - returns the array of args.
- getLabels() - Returns the array of labels.
- getName() - Returns post type name.

## PostTypeHelper usage

Once you have setup the pimple config you are use the PostTypeHelper like this
```
$helper = $pimple['postTypeHelper'];
$helper->registerPostTypes();

```
That's it, the helper will then add all the needed hooks and register all the post types you have provided it.

### Public methods
- registerPostTypes() - Registers the post types provided.
