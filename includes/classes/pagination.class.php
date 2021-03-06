<?php

    class pagination {
        public $firstPage = 1;
        public $lastPage;
        public $currentPage;
        public $itemLimit = 10;
        public $pageLimit = 9;
        public $showFirst = true;
        public $showLast = true;
        public $showNext = true;
        public $showPrev = true;
        public $showPageNumbers = true;
        public $i;
        public $offset;
        public $items = 0;
        public $prefix = '?';
        public $pageUrl = '';
		
        function __construct($last) {
            if($last != null) {
                $this->lastPage = $last;
                $this->items = $last;
            }
            
            if(isset($_GET['category']) && !isset($_GET['page'])) {
                $this->prefix = $_SERVER['REQUEST_URI'] . '/';
            }
            
            //Remove existing page query
			$queryString = preg_split('/(\?)/', $_SERVER['REQUEST_URI'], 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            $this->prefix = preg_replace('/(\?|\&)page=\d+/', '', $queryString[1] . $queryString[2]);
            
            //Change first & to ?
            $this->prefix = (strpos($this->prefix, '?') === false ? preg_replace('/\&/', '?', $this->prefix, 1) : $this->prefix);
            
            //Append ? or & 
            $this->prefix = $this->prefix . (strpos($this->prefix, '?') !== false ? '&' : '?');
			
			//Get current url offset
			$this->pageUrl = explode($_SERVER['SERVER_NAME'] . ROOT_DIR, explode('?', $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])[0])[1];
        }
        
        function setFirstPage($page = 1) {
            $this->firstPage = $page;
        }
        
        function setLastPage($page = 1) {
            $this->lastPage = $page;
        }
        
        function setItemLimit($limit = 10) {
            if($limit < 1) {
                $limit = 1;
            }
            
            $this->itemLimit = $limit;
        }
        
        function setPageLimit($limit = 9) {
            if($limit < 1) {
                $limit = 1;
            }
            
            $this->pageLimit = $limit;
        }
        
        function showPageNumbers($show = true) {
            $this->showPageNumbers = $show;
        }
        
        function showFirstLast($show = true) {
            $this->showFirst = $show;
            $this->showLast = $show;
        }
        
        function showNextPrevious($show = true) {
            $this->showNext = $show;
            $this->showPrev = $show;
        }
        
        function load() {
            if(isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] != null) {
                $this->currentPage = $_GET['page'];
            }
            else {
                $this->currentPage = $this->firstPage;
            }
            
            if($this->currentPage < $this->firstPage) {
                $this->currentPage = $this->firstPage;
            }
            
            if($this->currentPage > $this->pageLimit) {
                $this->i = $this->currentPage - $this->pageLimit;
            }
            else {
                $this->i = $this->firstPage;
            }
            
            if($this->lastPage != null) {
                $this->lastPage = ceil($this->lastPage / $this->itemLimit);
            }
            
            if(isset($_GET['page']) && $_GET['page'] > $this->lastPage) {
                $this->currentPage = $this->lastPage;
            }
            
            if($this->currentPage <= $this->firstPage) {
                $this->showFirst = false;
                $this->showPrev = false;
            }
            
            if($this->currentPage >= $this->lastPage) {
                $this->showLast = false;
                $this->showNext = false;
            }
            
            $this->offset = ($this->currentPage * $this->itemLimit) - $this->itemLimit;
        }
        
        function display() {
            if(($this->lastPage != null) && ($this->items > $this->itemLimit)) {
                if($this->currentPage <= $this->firstPage) {
                    $prevPage = $this->firstPage;
                }
                else {
                    $prevPage = $this->currentPage - 1;
                }
                
                if($this->currentPage >= $this->lastPage) {
                    $nextPage = $this->lastPage;
                }
                else {
                    $nextPage = $this->currentPage + 1;
                }
                
                $output = 
                    '<nav aria-label="page-navigation">
                        <ul class="pagination">';
                
                    if($this->showFirst == true) {
                        $output .= '<li class="page-item"><a class="page-link" href="' . $this->pageUrl . $this->prefix . 'page=' . $this->firstPage . '"><< First</a></li>';
                    }
                
                    if($this->showPrev == true) {
                        $output .= '<li class="page-item"><a class="page-link" href="' . $this->pageUrl . $this->prefix . 'page=' . $prevPage . '">< Prev</a></li>';
                    }
                
                    if($this->showPageNumbers == true) {
                        $end = $this->currentPage + $this->pageLimit;
                        
                        if($end >= $this->lastPage) {
                            $end = $this->lastPage;
                        }
                        
                        if($this->i <= $this->firstPage) {
                            $this->i = $this->firstPage;
                        }
                        
                        for($this->i; $this->i <= $end; $this->i++) {
                            $output .= '<li class="page-item ' . (isset($_GET['page']) && $_GET['page'] == $this->i ? 'active' : '') . '"><a class="page-link" href="' . $this->pageUrl . $this->prefix . 'page=' . $this->i . '">' . $this->i . '</a></li>';
                        }
                    }
                
                    if($this->showNext == true) {
                        $output .= '<li class="page-item"><a class="page-link" href="' . $this->pageUrl . $this->prefix . 'page=' . $nextPage . '">Next ></a></li>';
                    }
                
                    if($this->showLast == true) {
                        $output .= '<li class="page-item"><a class="page-link" href="' . $this->pageUrl . $this->prefix . 'page=' . $this->lastPage . '">Last >></a></li>';
                    }
                
                $output .= 
                        '</ul>
                    </nav>';
                
                return $output;
            }
        }
        
        function debug() {
            echo 'First Page: ' . $this->firstPage . '<br>' . 
                 'Last Page: ' . $this->lastPage . '<br>' . 
                 'Current Page: ' . $this->currentPage . '<br>' . 
                 'Items Per Page: ' . $this->itemLimit . '<br>' . 
                 'Page Numbers to Display: ' . $this->pageLimit . '<br>' . 
                 'Offset: ' . $this->offset . '<br>' . 
                 'Integer: ' . $this->i . '<br>' .
                 'Show First: ' . $this->showFirst . '<br>' . 
                 'Show Last: ' . $this->showLast . '<br>' .
		 'Prefix: ' . $this->prefix . '<br>' .
                 'Page: ' . $this->pageUrl . ' | ' . $_SERVER['SERVER_NAME'] . ROOT_DIR . '<br>';
        }
    }

?>
