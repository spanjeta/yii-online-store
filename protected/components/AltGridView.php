<?php 
class AltGridView extends CGridView {
        public function init() {
                parent::init();
        }
        /**
         * Renders a table body row.
         * @param integer $row the row number (zero-based).
         * Adds in data for drag & drop ordering if id and sort_order fields available.
         */
        public function renderTableRow($row)
        {
                $data=$this->dataProvider->data[$row];
                if (array_key_exists('id', $data->tableSchema->columns)) { 
                        $tag = '<tr data-record-id="'. CHtml::value($data,'id') . '"';
                        if(array_key_exists('sort_order', $data->tableSchema->columns)) {
                                $tag .= ' data-sort-order="'. CHtml::value($data,'sort_order') . '"';
                        }
                }
                else
                {
                        $tag = '<tr';
                }
                if($this->rowCssClassExpression!==null)
                {
                        echo $tag .= ' class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
                }
                else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
                        echo $tag .= ' class="'.$this->rowCssClass[$row%$n].'">';
                else
                        echo $tag .= '>';
                foreach($this->columns as $column)
                        $column->renderDataCell($row);
                echo "</tr>\n";
        }
}