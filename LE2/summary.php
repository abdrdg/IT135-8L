<?php
    class User 
    {
        private $name;
        private $contact_number;
        private $shipping_address;
        public $disc_priv;
        public $payment_method;

        function __construct($name, $contact_number, $shipping_address, $disc_priv, $payment_method) 
        {
            $this->name = $name;
            $this->contact_number = $contact_number;
            $this->shipping_address = $shipping_address;
            $this->disc_priv = $disc_priv;
            $this->payment_method = $payment_method;
        }

        function get_name()
        {
            return $this->name;
        }

        function get_contact_number()
        {
            return $contact_number->contact_number;
        }

        function get_shipping_address()
        {
            return $shipping_address->shipping_address;
        }
    }


    $user = new User($_POST['name'], $_POST['contact_number'], $_POST['shipping_address'], $_POST['disc_priv'], $_POST['payment_method']);

?>