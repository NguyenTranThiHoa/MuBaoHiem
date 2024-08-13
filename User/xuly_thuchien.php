<?php
// Đối tượng để thực hiện các thao tác với cơ sở dữ liệu
class Database {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function showlist($table) {
        $result = $this->conn->query("SELECT * FROM phanloai");
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}

// Khởi tạo đối tượng Database và chuyển kết nối vào
$db = new Database($conn);
/*-------------------------------------------------------------------------------*/

            // Đối tượng để thực hiện các thao tác với cơ sở dữ liệu
            class ThiHoa {
              private $conn;
              public function __construct($conn) {
                $this->conn = $conn;
              }
              public function showlist($table) {
                $result = $this->conn->query("SELECT ten, gia, anh FROM sanpham WHERE phanloai_id = 2");
                $data = array();
              while ($row = $result->fetch_assoc()) {
                $data[] = $row;
                }
                  return $data;
                }
              }
            // Khởi tạo đối tượng Database và chuyển kết nối vào
            $db = new Database($conn);

?>
<!----------------------------------------------------------->
    
