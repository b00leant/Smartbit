<?php namespace App;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Pagination\BootstrapThreePresenter;

class SmartbitPaginator{

    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="pagination repairs">%s %s</ul>',
                $this->getButtonPre(),
                $this->getButtonNext()
            );
        }
        return "";
    }
    public function getLinks()
    {
        
    }
    
    public function getButtonNext()
    {
        $url = $this->paginator->nextPageUrl();
        $btnStatus = 'waves-effect';

        if(empty($url)){
            $btnStatus = 'disabled';
        }
        return $btn = "<li class='".$btnStatus."'><a onclick='$(this).paginate('".$url."');' href='#!'><i class='material-icons'>chevron_right</i></a></li>";
    }

    public function getFirst()
    {
        $url = $this->paginator->url(1);
        $btnStatus = '';

        if(1 == $this->paginator->currentPage()){
            $btnStatus = 'disabled';
        }
        return $btn = "<a href='".$url."'><button class='btn btn-success ".$btnStatus."'><i class='glyphicon glyphicon-chevron-left'></i> First</button></a>";
    }

    public function getButtonPre()
    {
        $url = $this->paginator->previousPageUrl();
        $btnStatus = '';

        if(empty($url)){
            $btnStatus = 'disabled';
        }
        return $btn = "<li class='".$btnStatus."'><a onclick='$(this).paginate('".$url."');' href='#!'><i class='material-icons'>chevron_left</i></a></li>";
    }

    public function getLast()
    {
        $url = $this->paginator->nextPageUrl();
        $btnStatus = '';

        if(empty($url)){
            $btnStatus = 'disabled';
        }
        return $btn = "<a href='".$url."'><button class='btn btn-success ".$btnStatus."'>Next <i class='glyphicon glyphicon-chevron-right pagi-margin'></i><i class='glyphicon glyphicon-chevron-right'></i></button></a>";
    }

}