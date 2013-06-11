<!doctype html>
<html>
<head>
	<title>Các thành phần HTML cơ bản</title>
</head>
<body>

 <h1>Thẻ tiêu đề <a>cấp 1</a></h1>

  <div>
    Văn bản bên trong thẻ <code>div</code>. Đôi khi, người ta không dùng thêm thẻ
    <code>p</code> bên trong khối.
  </div>

  <h2>Tiêu đề <a>cấp 2</a></h2>

  <p>Trình bày các đoạn văn bản với thẻ <code>p</code>. Trong các đoạn văn bản, ta có thể
  dùng các thẻ <em>in nghiêng</em> hoặc <strong>in đậm</strong></p>

  <h3>Tiêu đề <a>cấp 3</a></h3>

  <blockquote>
    <p><strong>Một khối trích dẫn</strong>: Thường được dùng để <em>trích dẫn nội dung từ
    nơi khác</em>. Con cáo nâu nhảy qua con sói đen?!@#$%^&amp;*().</p>
  </blockquote>

  <h4>Tiêu đề <a>cấp 4</a></h4>

  <address>
    Địa chỉ liên hệ, <a>jkorpela@cs.tut.fi</a> Số điện thoại linh tinh...
  </address>

  <h5>Tiêu đề <a>cấp 5</a></h5>

  <h6>Tiêu đề <a>cấp 6</a></h6>
  <hr>

  <ul>
    <li>Danh sách chấm điểm <a>Cấp I</a></li>

    <li>Các danh sách có thể lồng vào nhau.

      <ul>
        <li>Đây là danh sách <a>Cấp II</a></li>

        <li>Thậm chí là nhiều cấp...

          <ul>
            <li>Còn đây là danh sách <a>Cấp III</a>.</li>

            <li>Thêm một cấp nữa cũng chưa phải là nhiều nhặn gì...

              <ul>
                <li>Phân thêm cấp nữa.</li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>

      <ol>
        <li>Đây là danh sách <a>Cấp II</a></li>

        <li>Nhưng lại là một danh sách đánh số...

          <ol>
            <li>Còn đây là danh sách <a>Cấp III</a></li>

            <li>Thêm một danh sách đánh số nữa...

              <ol>
                <li>Phân thêm cấp nữa.

                  <ol>
                    <li>Phân thêm cấp nữa.</li>
                  </ol>
                </li>
              </ol>
            </li>
          </ol>
        </li>
      </ol>
    </li>
  </ul>

  <ul>
    <li>HTML 5 còn có thêm thẻ <code>menu</code> nữa</li>

    <li>Danh mục thứ hai</li>

    <li>Danh mục thứ ba. Danh mục này dài hơn các danh mục trước, nên nó sẽ được bo lại
    trong dòng văn bản kế tiếp.</li>
  </ul>

  <p>Phần này là một danh sách dùng thẻ <code>dir</code>:</p>

  <ul>
    <li>Mục một.</li>

    <li>Mục hai.</li>

    <li>Mục ba. Phần này cũng có nhiều nội dung hơn các phần trước, để thử tính năng bo
    văn bản vào dòng kế tiếp.</li>
  </ul>

  <dl>
    <dt>Danh sách định nghĩa</dt>

    <dd>Mỗi definition list thường bao gồm nhiều mục</dd>

    <dt>Thuật ngữ</dt>

    <dd>Các thuật ngữ là thành phần cần được giải thích</dd>

    <dt>Chú giải</dt>

    <dd>Chú giải cho thuật ngữ ở phía trên. Thường thường thì phần chú giải sẽ dài hơn
    nhiều so với thuật ngữ của nó.</dd>
  </dl>

  <ul>
    <li><abbr title="Cascading Style Sheets">CSS</abbr> (từ viết tắt; dùng thẻ
    <code>abbr</code>)</li>

    <li><acronym title="radio detecting and ranging">radar</acronym> (từ đồng nghĩa; dùng
    thẻ <code>acronym</code> )</li>

    <li><b>in đậm</b> (dùng thẻ <code>b</code> - không có ngữ nghĩa)</li>

    <li><big>in chữ to</big> (dùng thẻ <code>big</code>)</li>

    <li><cite>Nguồn gốc các loài</cite> (nhan đề 1 cuốn sách; dùng thẻ
    <code>cite</code>)</li>

    <li><code>a[i] = b[i] + c[i);</code> (mã nguồn; dùng thẻ <code>code</code>)</li>

    <li>Các <del>văn bản đã bị xóa</del>(dùng thẻ <code>del</code>)
    </li>

    <li>một <dfn>khái niệm</dfn> là một từ được định nghĩa rõ, và khai báo sử dụng thẻ
    <code>dfn</code>.</li>

    <li>một từ được <em>nhấn mạnh</em> thông qua thẻ <code>em</code>.</li>

    <li><i lang="la">chữ in nghiêng</i> (nhưng không có nghĩa nhấn mạnh; dùng thẻ
    <code>i</code>)</li>

    <li>các chữ được <ins>chèn thêm vào</ins>(dùng thẻ <code>ins</code>)
    </li>

    <li>chọn <kbd>yes</kbd> khi được hỏi (dùng thẻ <code>kbd</code> để thông báo các dữ
    liệu nhập vào từ bàn phím)</li>

    <li><q>Xin chào!</q> <q>Tôi đáp <q>Tạm biệt!</q></q> (thẻ <code>q</code> trích dẫn
    trên cùng 1 dòng)</li>

    <li>Đầu ra <samp>mẫu ví dụ</samp> với thẻ <code>samp</code></li>

    <li><small>đây là chữ in nhỏ</small> (với thẻ <code>small</code>)</li>

    <li><strike>overstruck</strike> (dùng thẻ <code>strike</code>; chú ý: có thể dùng thẻ <code>s</code> để viết tắt cho <code>strike</code>)</li>

    <li><strong>văn bản được tô đậm</strong> (dùng thẻ <code>strong</code>)</li>

    <li>Các chỉ số trên và chỉ số dưới (thẻ <code>sub</code> và <code>sup</code>) xuất hiện trong văn bản hiện có.
    Ví dụ như x<sub>1</sub> và H<sub>2</sub>O (có chỉ số dưới). Chỉ số trên:
    M<sup>lle</sup>, 1<sup>st</sup>, biểu thức toán học: e<sup>x</sup>,
    sin<sup>2</sup> <i>x</i>, có nhiều cấp (số mũ chả hạn):
    e<sup>x<sup>2</sup></sup> và f(x)<sup>g(x)<sup>a+b+c</sup></sup> (trong đó 2 và a+b+c
    sẽ có dạng số mũ của số mũ).</li>

    <li>Phông chữ <tt>có độ rộng cố định</tt> (dùng thẻ <code>tt</code>)</li>

    <li>Văn bản <u>gạch chân</u> (thẻ <code>u</code>)</li>

    <li>Câu lệnh <code>cat</code> <var>filename</var> trình bày tệp tin được chỉ định bởi tham số <var>filename</var> 
    (thẻ <code>var</code> dùng để đánh dấu các tên biến).</li>
  </ul>

  <p>Một số thành phần ở trên sẽ được hiển thị dưới dạng phông chữ có độ rộng cố định,
  nên sẽ có <em>cùng một hình thức trình bày</em>. Phần này kiểm tra xem chúng có 
  được trình bày giống nhau trên trình duyệt của bạn hay không:</p>

  <ul>
    <li><code>Văn bản nằm trong thẻ code</code></li>

    <li><kbd>Văn bản nằm trong thẻ kbd</kbd></li>

    <li><samp>Văn bản nằm trong thẻ samp</samp></li>

    <li><tt>Văn bản nằm trong thẻ tt</tt></li>
  </ul>
  
  <ul>
    <li><a href="../index.html">Trang chủ</a></li>

    <li><a href="http://www.unicode.org/versions/Unicode4.0.0/ch06.pdf" title="Writing Systems and Punctuation" type="application/pdf">Chuẩn Unicode, chương&nbsp;6</a></li>
  </ul>

  <p>Đoạn văn này chứa một vài liên kết. Thường thì, các liên kết viết liền dòng 
  (không giống như các danh sách liên kết) sẽ gây lỗi <a href=
  "http://www.useit.com">về cách dùng</a> nhưng chúng thường biểu thị các mục liên kết không quan trọng lắm. Tham khảo 
  <cite><a href="links.html">Liên kết thích là liên kết</a></cite>.</p>
  
  <h2>Bảng biểu</h2>

  <p>Bảng sau có chứa phần tiêu đề dành riêng cho bảng. Dòng đầu tiên và cột đầu tiêu chứa các tiêu đề bảng (đối tượng <code>th</code>); các ô khác chứa dữ liệu
  (dùng <code>td</code>), với thuộc tính <code>align="right"</code>:</p>

  <table summary="Bảng số liệu thử nghiệm">
    <caption>
      Diện tích các nước Bắc Âu
    </caption>

    <tr>
      <th scope="col">Quốc gia</th>

      <th scope="col">Tổng diện tích</th>

      <th scope="col">Diện tích đất</th>
    </tr>

    <tr>
      <th>Đan Mạch</th>

      <td>43,070</td>

      <td>42,370</td>
    </tr>

    <tr>
      <th>Phần Lan</th>

      <td>337,030</td>

      <td>305,470</td>
    </tr>

    <tr>
      <th>Iceland</th>

      <td>103,000</td>

      <td>100,250</td>
    </tr>

    <tr>
      <th>Na Uy</th>

      <td>324,220</td>

      <td>307,860</td>
    </tr>

    <tr>
      <th>Thụy Điển</th>

      <td>449,964</td>

      <td>410,928</td>
    </tr>
  </table>
  <hr title="Thông tin về tài liệu này">

  <address>
    <a href="../personal.html" hreflang="en" lang="vi">Nguyễn Đình Trung</a>
    210 D1 Trung Tự, Đống Đa, Hà Nội.
  </address>
</body>
</html>  
