<?php

namespace Creonit\PropelImageBehavior\Image;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\ForeignKey;

class ImageBehavior extends Behavior
{
    protected $parameters = [
        'parameter' => 'image_id',
    ];
    
    protected function addImageColumn($columnName){
        $table = $this->getTable();

        $table->addColumn([
            'name' => $columnName,
            'type' => 'integer'
        ]);

        $fk = new ForeignKey();
        $fk->setForeignTableCommonName('image');
        $fk->setForeignSchemaName($table->getSchema());
        $fk->setDefaultJoin('LEFT JOIN');
        $fk->setOnDelete(ForeignKey::SETNULL);
        $fk->setOnUpdate(ForeignKey::CASCADE);
        $fk->addReference($columnName, 'id');
        $table->addForeignKey($fk);
    }

    public function modifyTable()
    {
        $columns = explode(',', $this->getParameter('parameter'));
        foreach ($columns as $column){
            $this->addImageColumn(trim($column));
        }
    }

    public function objectMethods($builder)
    {
        return $this->renderTemplate('objectMethods', ['table' => $this->getTable(), 'columns' => explode(',', $this->getParameter('parameter'))]);
    }
}