<?php

// Giả sử bạn cần trao đổi công việc với một người nước ngoài (nước Anh), nhưng bạn không biết tiếng Anh và người nước ngoài kia cũng không biết Tiếng Việt, bạn cần một bộ phiên dịch để hiểu người đó đang nói gì.

class SimpleTranslate {
    private $sentence;

    function __construct($sentence) {
        $this->sentence = $sentence;
    }

    function getSentence() {
        return $this->sentence;
    }
}

class TranslateAdapter {
    private $sentence;
    function __construct(SimpleTranslate $translate) {
        $this->sentence = $translate;
    }
    function getVietNamese() {
        $sentence = $this->sentence->getSentence();
        switch($sentence){
            case "Hello":
                {
                    return "Xin chào";
                    break;
                }
            case "What do you think about that?":
                {
                    return "Bạn nghĩ sao về việc đó?";
                    break;
                }
            case "Bye":
                {
                    return "Tạm biệt";
                    break;  
                }
            default: return "Chưa dịch được";
        }
        
    }
}

    $translate = new SimpleTranslate("What do you think about that?");
    $translateAdapter = new TranslateAdapter($translate);
    echo 'Câu sau khi dịch: '.$translateAdapter->getVietNamese();

    echo "<br/>";

    $translate_2 = new SimpleTranslate("Hello");
    $translateAdapter_2 = new TranslateAdapter($translate_2);
    echo 'Câu sau khi dịch: '.$translateAdapter_2->getVietNamese();

    echo "<br/>";
    
    $translate_3 = new SimpleTranslate("What's your name?");
    $translateAdapter_3 = new TranslateAdapter($translate_3);
    echo 'Câu sau khi dịch: '.$translateAdapter_3->getVietNamese();

    // Câu sau khi dịch: Bạn nghĩ sao về việc đó?
    // Câu sau khi dịch: Xin chào
    // Câu sau khi dịch: Chưa dịch được
?>