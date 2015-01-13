# diff

###Index: amfphp/core/shared/util/MethodTable.php

    function cleanComment($comment) { ...
		// eregi_replace() (使用 preg_replace() 配合 'i' 修正符替代)
		// $comment = eregi_replace("\n[ \t]+", "\n", trim($comment));
		+ $comment = preg_replace("\n[ \t]", "\n", trim($comment));
		$comment = str_replace("\n", "\\n", trim($comment));
    // $comment = eregi_replace("[\t ]+", " ", trim($comment));
		+ $comment = preg_replace("[\t ]", " ", trim($comment));
		}

###Index: amfphp/core/shared/app/php5Executive.php

  function service() { ...
  
   + date_default_timezone_set('Asia/Taipei'); // 增加時區
    
    $dateStr = date("D, j M Y ") . date("H:i:s", strtotime("-2 days"));

  }

