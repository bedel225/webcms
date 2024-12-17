<?php 

if(isset($_POST['connexion'])){
    //verifacation de saisie de tous les champs
    if(!empty($_POST['email'])  || !empty($_POST['password']) ){
        $message = 'Veuillez remplir tous les champs.';
    }else{
        //verifaction du mail en base de données 
        $requet = $BDDpdo->prepare('SELECT * FROM utilisateurs WHERE email_utilisateur = :email');
        $requet->bindvalue(':email',$_POST['email']);
        $result = $requet->execute();
        $result->fetch();

        if(!isset($result) || empty($result)){
            $message = 'Veuillez saisie un email valide';
        }else{
            $isValide = password_verify($_POST['password'], $result['password']);
            // if($isValide){
                
            // }
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" method="post" >
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" />
                                                <label for="inputEmail">Adresse email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" />
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="sesouvenir" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Se souvenir de moi</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Mot de passe oublié?</a>
                                                <a class="btn btn-primary" href="index.php" name="connexion" >Connexion</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
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
