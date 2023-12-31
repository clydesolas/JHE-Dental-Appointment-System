<!-- modal -->
<div class="modal" id="logoutModal" data-bs-backdrop="true">
                                            <div class="modal-dialog" >
                                                <div class="modal-content rounded-4 shadow">
                                                <div class="modal-header border-bottom-0">
                                                    <h1 class="modal-title fs-5"> </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body py-0">
                                                    <br><h5 style="text-align:center">Are you sure you want to log out?</h5><br>
                                                </div>
                                                <div class="modal-footer flex-column border-top-0">
                                                    <a type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" href="../logout.php">Log out</a>
                                                    <a type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">Close</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- modal -->
<script>
$('.modal').appendTo("body") 
</script>

<style>.modal-backdrop {
z-index: 0;
}</style>