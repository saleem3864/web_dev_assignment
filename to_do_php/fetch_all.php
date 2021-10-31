<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    } else {
        if ($result = $connection->query("SELECT task_id,data,created_on,status FROM to_do WHERE status ='not-completed' AND user = '{$_SESSION['USER']}'  ORDER BY created_on DESC;")) {
            //echo 'Inserted';
            $sr = 1;
            if (mysqli_num_rows($result)!=0) {
                echo "<table class='w3-table w3-striped w3-hoverable w3-border'>
                <tr class='w3-grey w3-hover-grey'>
                    <th style='width: 5%;'>Sr.</th>
                    <th style='width: 55%;''>Task Details</th>
                    <th style='width: 10%;'>Created On</th>
                    <th style='width: 10%; vertical-align: middle;'>Actions</th>
                </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                <td>
                                    <p>{$sr}</p>
                                </td>
                                <td>
                                    <p>{$row['data']}</p>
                                </td>
                                <td>
                                    <p>{$row['created_on']}</p>
                                </td>
                                <td style='vertical-align: middle;'>
                                    <div style='text-align: end;'><button class='w3-button w3-circle w3-green w3-hover-grey' onclick=update_status({$row['task_id']},'completed');><i class='fa fa-check'></i></button><button class='w3-button w3-circle w3-red w3-hover-grey' onclick=update_status({$row['task_id']},'deleted');><i class='fa fa-times'></i></button><button class='w3-button w3-circle w3-blue w3-hover-grey' onclick=\"set_update_data('".strval($row['data'])."',{$row['task_id']});\"><i class='fa fa-pencil'></i></button></div>
                                </td>
                            </tr>";
                            $sr++;
                            
                }
                echo '</table>';
                
            } else {
                echo "<h3 class='w3-text-green' style='text-align: center;'>No Tasks Yet!</h3>";
            }
        } 
        else {
            echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";
            echo "SELECT data,created_on,status FROM messages WHERE status ='not-completed' AND user = '{$_SESSION['USER']}'  ORDER BY created_on DESC;";
            }
        }
        $connection->close();
    }
else{
    echo "NOT LOGGED IN.";
}
?>




