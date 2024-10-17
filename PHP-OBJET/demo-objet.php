<?php
    class A {
        private $x;
        public $y;

        public function add($num1, $num2) {
            return $num1 + $num2;
        }

        public function getX() {
            return $this->x;
        }

        public function setX($v) {
            $this->x = $v;
        }
    }

    class B {
        private $x;
        private $y;

        public function add($num1, $num2) {
            return ($num1 + $num2) * 2;
        }

        public function getX()
        {
                return $this->x;
        }

        public function setX($x)
        {
                $this->x = $x;

                return $this;
        }

        public function getY()
        {
                return $this->y;
        }

        public function setY($y)
        {
                $this->y = $y;

                return $this;
        }

    }
//----------------------------------------------------------
    class C extends A {


        public function getY()
        {
                return $this->y;
        }

        public function setY($y)
        {
                $this->y = $y;

                return $this;
        }
    }
//----------------------------------------------------------
    class D {
        private $x;
        private $y;
        public function __construct($v1 =0 , $v2 = 0) {
            $this->x = $v1;
            $this->y = $v2;
        }

        /**
         * Get the value of x
         */ 
        public function getX()
        {
                return $this->x;
        }

        /**
         * Set the value of x
         *
         * @return  self
         */ 
        public function setX($x)
        {
                $this->x = $x;

                return $this;
        }

        /**
         * Get the value of y
         */ 
        public function getY()
        {
                return $this->y;
        }

        /**
         * Set the value of y
         *
         * @return  self
         */ 
        public function setY($y)
        {
                $this->y = $y;

                return $this;
        }
    }

    //----------------------------------------------------------
    class E {
        public static $x = 250;
        private $y;
        public static function add($num1, $num2){
            return $num1 + $num2;
        }
    }

    // ------------------------TEST
    echo E::$x;
    echo "<br>";
    echo E::add(5, 20);
    die;

    //-----------------------------------
    // $d = new D(10, 20);
    // $d->setX(20);
    $d = new D();
    $d->setX(30); // quand le parametres de constructeur sont definie par default
    
    echo $d->getX();
    die;

    //-----------------------------------
    $c = new C();
    $c -> setX(1000);
    $num1 = $c -> getX();

    $c -> setY(2000);
    $num2 = $c->getY();
    echo $c->add($num1, $num2);

    //-----------------------------------
    $a = new A();
    $b = new B();

    $x = $a->setX(250);
    $x = $a->getX();

    $za = $a->add(10, 20);
    $zb = $b->add(10,20); 

    echo "za = $za et zb = $zb";


    
    