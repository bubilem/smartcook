<?php

class ClientController
{
    const BR = '<BR>';

    public function run(): void
    {
        echo self::BR . "Echo" . self::BR;
        $merchantId = '96b43a83';
        $data = [];
        $data['merchantId'] = $merchantId;
        $data['dttm'] = Date::nowToSend();
        $user = new UserModel();
        $user->load($merchantId);
        $data['signature'] = Signature::sign(implode("|", $data), $user->getPrivateKey());
        echo "Preparing POST cURL" . self::BR;
        $url = 'www/payway/api/echo';
        echo "url: $url " . self::BR;
        $postData = json_encode($data);
        echo "Post data: $postData " . self::BR;
        $cUrl = curl_init($url);
        curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cUrl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($cUrl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cUrl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json;charset=UTF-8'
        )
        );
        $result = curl_exec($cUrl);
        if (curl_errno($cUrl)) {
            echo "cUrl exec failed, errno: " . htmlspecialchars(curl_error($cUrl)) . self::BR;
            return;
        } else {
            echo "cUrl exec not failed" . self::BR;
        }
        echo 'http response: ' . htmlspecialchars(curl_getinfo($cUrl, CURLINFO_HTTP_CODE)) . self::BR;
        if (curl_getinfo($cUrl, CURLINFO_HTTP_CODE) != 200) {
            return;
        }
        curl_close($cUrl);
        $resultArray = json_decode($result, true);
        echo 'Recieved data: ' . json_encode($resultArray) . self::BR;
        if (is_null($resultArray['dttm']) || is_null($resultArray['resultCode']) || is_null($resultArray['resultMessage']) || is_null($resultArray['signature'])) {
            echo 'Missing dttm or resultCode or resultMessage or Signature' . self::BR;
            return;
        } else {
            echo 'All data (dttm, resultCode, resultMessage, Signature) recieved' . self::BR;
        }

        $signature = $resultArray['signature'];
        unset($resultArray['signature']);
        $data2Sign = implode("|", $resultArray);
        $publicKey = file_get_contents(DATA_DIR . 'keys/payway-public-key.pub');
        if (Signature::verify($data2Sign, $signature, $publicKey)) {
            echo 'Signature: verified' . self::BR;
        } else {
            echo 'Signature: NOT verified' . self::BR;
        }
    }
}
