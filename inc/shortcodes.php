<?php 

// action hook 
add_action('init' , 'lecture_pg_init');

function lecture_pg_init() {
    add_shortcode('test' , 'my_pg_test');
}


// function my_pg_test($arrg){      simple withg message parameter
//     // $arrg = shortcode_atts();
//     return $arrg['message'];
    
// }

function my_pg_test($arrg){                                  // condition if messagge key not found
    class links
    {
        public $a;
        public $b;
        public	function __construct($a)
        {
            $this->data = $a;
            $this->next = NULL;
        }
    }
    
    class SingleLL
    {
        public $head;
        public $tail;
        public	function __construct()
        {
            $this->head = NULL;
            $this->tail = NULL;
        }
        // Add new node at the end of linked list
        public	function addNode($value)
        {
            // Create a new node
            $node = new links($value);
            if ($this->head == NULL)
            {
                $this->head = $node;
            }
            else
            {
                $this->tail->next = $node;
            }
            $this->tail = $node;
        }
        // Display linked list element
        public	function display()
        {
            if ($this->head == NULL)
            {
                return;
            }
            $temp = $this->head;
            // iterating linked list elements
            while ($temp != NULL)
            {
                printf("%d → ",$temp->data);
                // Visit to next node
                $temp = $temp->next;
            }
            printf("NULL\n");
        }
        // Remove the duplicate nodes from sorted singly linked list
        public	function deleteDuplicate()
        {
            if ($this->head == NULL)
            {
                return;
            }
            else
            {
                // Auxiliary variables
                $temp = $this->head->next;
                $current = $this->head;
                $hold = NULL;
                // Find and remove duplicate
                while ($temp != NULL)
                {
                    // Check duplicate node 
                    if ($current->data == $temp->data)
                    {
                        //  When node key are same
                        $hold = $temp;
                    }
                    else
                    {
                        // When node key are not same
                        $current = $temp;
                    }
                    // Visit to next node
                    $temp = $temp->next;
                    if ($hold != NULL)
                    {
                        // Modified link value
                        $current->next = $temp;
                        $hold = NULL;
                    }
                    else
                    {
                        // Change last node
                        $this->tail = $current;
                    }
                }
            }
        }
        public static
        function main($args)
        {
            $sll = new SingleLL();
            // Sorted Linked list node
            //  1 → 1 → 2 → 3 → 4 → 4 → 4 → 5 → 6 → 7 → NULL
            $sll->addNode(1);
            $sll->addNode(1);
            $sll->addNode(2);
            $sll->addNode(3);
            $sll->addNode(4);
            $sll->addNode(4);
            $sll->addNode(4);
            $sll->addNode(5);
            $sll->addNode(6);
            $sll->addNode(7);
            printf("Before Delete\n");
            $sll->display();
            $sll->deleteDuplicate();
            printf("After Delete\n");
            // 1 → 2 → 3 → 4 → 5 → 6 → 7 → NULL
            $sll->display();
        }
    }
    
    SingleLL::main(array());
    
}


// filter hook 

// add_filter('the_title' , 'lecture_pg_the_title');
// function lecture_pg_the_title($title) {
//     return "Your Title is updated Now ";

// }




