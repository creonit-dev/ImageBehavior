<?php

    foreach($columns as $column):
        $column = $table->getColumn(trim($column));
?>

public function get<?php print preg_replace('/Id$/', 'Url', $column->getPhpName()) ?>(){
    return $this-><?php print $column->getName() ?> ? $this->getImage<?php if(count($columns) > 1) print 'RelatedBy' . $column->getPhpName() ?>()->getUrl() : '';
}


<?php
    endforeach;
?>
