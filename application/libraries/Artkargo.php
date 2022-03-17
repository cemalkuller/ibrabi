<?php
/*
 * ARTKARGO API system
 * v1.0
 * */

//namespace ARTKARGO\Libraries;

class artkargo
{


    private $API_KEY = ""; /* ARTKARGO'dan talep ediniz. */
    private $url = "https://www.artkargo.com/api/";
    private $return_type = "json";

    private $errors = array();
    private $params = array();

    public function __construct()
    {

    }

    public function setApiKey($data = "")
    {
        $this->API_KEY = $data;
        return $this;
    }

    public function setReturnType($data = "json")
    {
        $this->return_type = $data;
        return $this;
    }

    public function setParams($data = array())
    {
        $this->params["data"] = $data;
        return $this;
    }

    /* Kargo */
    public function yeni_olustur()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "POST";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function kargo_sorgula()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function kargo_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    /* Tanımlar */
    public function il_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }
    
    public function ulke_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function ilce_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function teslimat_tipi_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function odeme_tipi_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function odeme_sekli_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    public function kargo_durum_liste()
    {
        try {
            $this->api_method = 'kargo/' . __FUNCTION__;
            $this->call_method = "GET";

            $this->call();

        } catch (Exception $e) {
            $this->errors[__FUNCTION__][0] = $e;
        }
        return $this;
    }

    private function call()
    {
        /* url oluşturuluyor */
        $url = $this->url . $this->api_method;

        /* parametre tamamlanıyor */
        $this->params["auth"]["token"] = $this->API_KEY;
        $json = array("reqjson" => json_encode($this->params));

        $ch = curl_init();

        if ($this->call_method == "GET" && $json) {
            if (count($json) > 0) {
                $url .= "/?";
                $i = 0;
                foreach ($json as $k => $v) {
                    $i++;
                    $url .= $k . "=" . $v . (count($json) > $i ? '&' : '');
                }
            }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->call_method);

        if ($this->call_method == "POST") curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $data = curl_exec($ch);
        $err = curl_error($ch);

        $this->response = json_decode($data, true);
        if ($err) $this->errors[__FUNCTION__][0] = $err;

        curl_close($ch);

        return $this;
    }

    public function setHeadAsJson()
    {
        header('Content-type:text/json');
        return $this;
    }

    public function getResponse(bool $isWantArray = null)
    {
        $return = array();

        if (count($this->errors) > 0) {
            $return["error"] = array(
                "status" => false,
                "message" => "Hata oluştu api çalıştırılamadı.",
                "datail" => $this->errors,
            );
        }

        $return["response"] = $this->response;

        if ($isWantArray) {
            return $this->response;
        }

        $json = json_encode($return);
        return $json;
    }

}
