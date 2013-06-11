<?php 
$options =<<<HEREDOC
CSS (từ viết tắt; dùng thẻ abbr)
radar (từ đồng nghĩa; dùng thẻ acronym )
in đậm (dùng thẻ b - không có ngữ nghĩa)
in chữ to (dùng thẻ big)
Nguồn gốc các loài (nhan đề 1 cuốn sách; dùng thẻ cite)
a[i] = b[i] + c[i); (mã nguồn; dùng thẻ code)
Các văn bản đã bị xóa(dùng thẻ del)
một khái niệm là một từ được định nghĩa rõ, và khai báo sử dụng thẻ dfn.
một từ được nhấn mạnh thông qua thẻ em.
chữ in nghiêng (nhưng không có nghĩa nhấn mạnh; dùng thẻ i)
các chữ được chèn thêm vào(dùng thẻ ins)
chọn yes khi được hỏi (dùng thẻ kbd để thông báo các dữ liệu nhập vào từ bàn phím)
"Xin chào!" "Tôi đáp "Tạm biệt!"" (thẻ q trích dẫn trên cùng 1 dòng)
Đầu ra mẫu ví dụ với thẻ samp
đây là chữ in nhỏ (với thẻ small)
overstruck (dùng thẻ strike; chú ý: có thể dùng thẻ s để viết tắt cho strike)
văn bản được tô đậm (dùng thẻ strong)
Các chỉ số trên và chỉ số dưới (thẻ sub và sup) xuất hiện trong văn bản hiện có. Ví dụ như x1 và H2O (có chỉ số dưới). Chỉ số trên: Mlle, 1st, biểu thức toán học: ex, sin2 x, có nhiều cấp (số mũ chả hạn): ex2 và f(x)g(x)a+b+c (trong đó 2 và a+b+c sẽ có dạng số mũ của số mũ).
Phông chữ có độ rộng cố định (dùng thẻ tt)
Văn bản gạch chân (thẻ u)
Câu lệnh cat filename trình bày tệp tin được chỉ định bởi tham số filename (thẻ var dùng để đánh dấu các tên biến).
    
HEREDOC;

$options = explode("\n", $options);
	$ret = array();
	foreach ($options as $k => $row){
		$ret[] = "var".$k."=".$row;
	}
	echo implode("&", $ret);
?>
