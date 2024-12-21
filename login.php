<?php 

if(isset($_POST['connexion'])){
    $email = $_POST['email'];
    $current_password = $_POST['password']; 
    //verifacation de saisie de tous les champs
    if( empty($email) || empty($current_password) ){
        $message = 'Veuillez remplir tous les champs.';
    }else{
        //verifaction du mail en base de données 
        include_once "includes/bdd.php";

        $requet = $BDDpdo->prepare('SELECT * FROM utilisateurs WHERE email_utilisateur = :email');
        $requet->bindvalue(':email',$email);
        $requet->execute();
        $result = $requet->fetch(); 

        if(!isset($result) || empty($result)){
            $message = 'Veuillez saisie un email valide';
        }elseif($result['verification_email_utilisateur']==0){
            include_once "includes/token.php";
            $update = $BDDpdo->prepare('UPDATE utilisateurs SET token_utilisateur = :token WHERE email_utilisateur = :email');
            $update->bindvalue(':email',$email);
            $update->bindvalue(':token',$token);
            $result = $update->execute();
            include_once "includes/PHPMailer/sendmail.php";
            $subject = 'Confirmation d\'email';

            sendmail($email, $subject, $token, 'username');

            $message = 'Veuillez confirmez votre adresse email en cliquant sur le lien que vous venez de recevoir à l\'adreese email '.$email;
        }else{

            $isValide = password_verify($current_password, $result['password_utilisateur']);
            if($isValide){

                session_start();
                $message ='vous etes connecté.';

                $_SESSION['id_ytilisateur'] = $result['id_utilisateur'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['email_utilisateur'] = $resul['email_utilisateur'] ;
                $_SESSION['role_utilisateur'] = $resul['role_utilisateur'] ;
    
                if(isset($_POST['sesouvenir'])){
                    setcookie('email', $_POST['email'], time()+3600*24*365);
                    setcookie('password', $_POST['password'], time()+3600*24*365);
                }else{
                    if(isset($_COOKIE['email'])){
                        setcookie($_COOKIE['email'],"");
                    }
                    if(isset($_COOKIE['password'])){
                        setcookie($_COOKIE['password'],"");
                    }
                }
                header('location:index.php');
            }else{
            $message = 'mot de passe non valide, veuillez saisi le bon mot de passe.';
            }
        }

    }
}
?>

<?php include "includes/header_login.php"; ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    <?php if(isset($message)){
                                            echo $message;
                                        }
                                        ?>  
                                    <h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" method="post" >
                                        <form action="login.php" method="post" >
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" value = <?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'] ;}?>  />
                                                <label for="inputEmail">Adresse email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" value = <?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'] ; ?> />
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="sesouvenir" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Se souvenir de moi</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Mot de passe oublié?</a>
                                                <input class="btn btn-primary" type="submit" name="connexion" />
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Besoin d'un compte? S'enregistrer!</a></div>
                                        <div class="small"><a href="register.html">Besoin d'un compte? S'enregistrer!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
            <?php include "includes/footer.php"; ?>
            <?php include "includes/footer.php"; ?>
