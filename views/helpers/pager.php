<?php

class PagerHelper extends Helper {
    public $helpers = array(
        'Html',
        'Paginator'
    );

    public function sort($value) {
        $this->_setPagerParameters();
        $this->Paginator->sort($value);
    }

    public function display() {
        $this->_setPagerParameters();
        $output = '<div class="pager">';
        $output .= '<span>';
        $output .= $this->Paginator->first('« First ', array('tag' => 'span', 'class' => 'disabled'));
        $output .= $this->Paginator->prev('« Previous ', null, null, array('tag' => 'span', 'class' => 'disabled'));
        $output .= $this->Paginator->numbers(array(
            'separator' => ' | ',
            'modulus' => 6,
            'escape' => false
        ));
        $output .= $this->Paginator->next(' Next »', null, null, array('tag' => 'span', 'class' => 'disabled'));
        $output .= $this->Paginator->last(' Last »', array('tag' => 'span', 'class' => 'disabled'));
        $output .= '</span>';
        $format = 'Page %page% of %pages% ( %start% ~ %end% of %count% )';
        $output .= sprintf('<span>%s</span>', $this->Paginator->counter(array(
            'format' => $format
        )));
        $output .= '</div>';
        return $output;
    }

    public function _setPagerParameters() {
        $params = $this->params['url'];
        $queryPararms = Set::remove($params, 'url');
        if (!empty($queryPararms)) {
            $this->Paginator->options(array(
                'url' => am($this->params['pass'], array('?' => $queryPararms))
            ));
        }
    }

    public function total() {
        return $this->Paginator->counter(array('format' => '%start% ~ %end% of %count%'));
    }
}
