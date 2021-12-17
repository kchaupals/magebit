<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script type="text/javascript">
        // For delete button
        function validateDel() {
            var conf = confirm('Are you sure want to delete this record?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>
    <title>Data</title>
</head>

<body>
    <div class="container" style="padding-top:25px;">
        <div class="row">
            <div class="col-7">
                <form method='GET' action='<?php URLROOT ?>/emails/index/' name='filter-f'>   
                <select class='form-select my-1' name='filterby' aria-label='Default select example' style="width: 145px;display:inline;">
                        <option value="emailasc" <?php if($_SESSION['filterParams'] == 'emailasc') echo 'selected'?>>E-mail ASC</option>
                        <option value="emaildesc" <?php if($_SESSION['filterParams'] == 'emaildesc') echo 'selected'?>>E-mail DESC</option>
                        <option value="sdateasc" <?php if($_SESSION['filterParams'] == 'sdateasc') echo 'selected'?>>Date ASC</option>
                        <option value="sdatedesc" <?php if($_SESSION['filterParams'] == 'sdatedesc') echo 'selected'?>>Date DESC</option>
                    </select>
                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                    <input type="date" value="<?php if(!empty($_SESSION['searchDate'])){ echo $_SESSION['searchDate']; }  else {echo ' ';} ?>" name="searchByDate" class="form-control my-1" style="width: 200px;display:inline;">
                    <button type="submit" class="btn btn-outline-secondary">Search by date</button>
                    <input type="text" name="findEmail" value="<?php if(!empty($_SESSION['searchMail'])){ echo $_SESSION['searchMail']; }  else {echo '';} ?>" placeholder="Enter email to find..." class="form-control my-1" style="width: 200px;display:inline;">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                    <a class='btn btn-outline-secondary text-decoration-none' href='<?php URLROOT ?>/emails'>Reset</a>
           
                 <p class='lead'>Sort by Email provider</p>
                <a class='btn btn-outline-secondary text-decoration-none' href='<?php URLROOT ?>/emails'>all</a>
                    <?php if((is_array($data['providers'])) && (empty($_SESSION['selectedProvider']))) :?>
                    <?php foreach ($data['providers'] as $provider) : ?>
                        <button name='mailProvider' value='<?php echo $provider['domain'] ?>' class='btn btn-outline-secondary'><?php echo $provider['domain'] ?></button>
                    <?php endforeach; ?>
                    <?php endif;?>
            </form>
                
            </div>
        </div>
        <table class='table'>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <?php if(!$data['output']){
                echo '<tbody><tr><td>Data not found</td><td></td><td></td></tr></tbody>';
            } else {
                foreach($data['output']['data'] as $res): ?>
                    <tbody>
                        <tr>
                            <td><?= $res['email'] ?></td>
                            <td><?= $res['sub_date'] ?></td>
                            <td>
                                <form method="POST" id="delete"><button type="submit" name="delid" class="btn btn-outline-secondary" title="Delete this email" value="<?= $res['id'] ?>"><a class="link-dark" href="<?php echo URLROOT ?>/emails/" onclick="validateDel();" title="Delete this email"><i class="bi bi-trash"></i></a></button>
                            </td>
                        </tr>
                    </tbody>
            <?php endforeach;}?>
        </table>
        <br>

    </div>
</body>

</html>