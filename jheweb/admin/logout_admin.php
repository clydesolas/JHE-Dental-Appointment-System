<!-- modal -->
<div class="modal" id="logout_admin" data-bs-backdrop="static">
            <div class="modal-dialog" >
                <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5"> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <br><h3 style="text-align:center">Are you sure you want to log out?</h3><br>
                </div>
                <div class="modal-footer flex-column border-top-0">
                    <a type="button" style="text-decoration:none" class="btn btn-lg btn-primary w-100 mx-0 mb-2" href="../logout.php">Log out</a>
                    <a type="button" style="text-decoration:none"class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">Close</a>
                </div>
                </div>
            </div>
        </div>

        <script>
            $('.modal').appendTo("body") 
        </script>
<style>
    @media(max-width:767px){
.modal{
    padding-top:16%;
}
}
@media screen and (min-width:768px)and (max-width:1023px) {
    .modal{
    padding-top:16%;
} 
}
@media screen and (min-width:1024px){
    .modal{
    padding-top:5%;
}
}
</style>                                      
                                     