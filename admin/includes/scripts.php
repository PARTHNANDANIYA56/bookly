<!-- datatable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="js/app.js"></script>
<!-- sweet alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- datatable -->
<script>
	$(document).ready(function() {

		if ($("#collapseExample1").hasClass('active') || $("#collapseExample2").hasClass('active')) {
			$("#collapseExample1").show();
			$("#collapseExample2").show();
		} else {

			$("#collapseExample1").hide();
			$("#collapseExample2").hide();
		}
		$("#toggle").click(function() {
			$("#collapseExample1").slideToggle(500); // toggle collapse
			$("#collapseExample2").slideToggle(600); // toggle collapse
		});

		var t1 = $('#example').DataTable();

		t1.on('order.dt search.dt', function() {
			let i = 1;
			t1.cells(null, 0, {
				order: 'applied'
			}).every(function(cell) {
				this.data(i++);
			});
		}).draw();

		var user = $('#users').DataTable();

		user.on('order.dt search.dt', function() {
			let i = 1;
			user.cells(null, 0, {
				order: 'applied'
			}).every(function(cell) {
				this.data(i++);
			});
		}).draw();

		var t = $('#acategory').DataTable();

		t.on('order.dt search.dt', function() {
			let i = 1;
			t.cells(null, 0, {
				order: 'applied'
			}).every(function(cell) {
				this.data(i++);
			});
		}).draw();
	});



	function togleactive(id) {
		var id = id;
		$.ajax({
			url: "aproval.php",
			type: "post",
			data: {
				catId: id
			},
			success: function(result) {
				if (result == '1') {
					swal("Done!", "Book is Shows", "success");
				} else {
					swal("Error!", "Book is Blocked", "error");
				}
			}
		});
		// alert("Your Is id" + id);
	}

	function useractivate(id) {
		var id = id;
		$.ajax({
			url: "user_aproval.php",
			type: "post",
			data: {
				catId: id
			},
			success: function(result) {
				if (result == '1') {
					swal("Done!", "User is Unbloacked", "success");
				} else {
					swal("Error!", "User is Blocked", "error");
				}
			}
		});
		// alert("Your Is id" + id);
	}

	function deleterow(id) {
		var id = id;

		// confirm_btn
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: "delete.php",
						type: "post",
						data: {
							'book_id': id,

						},
						success: function(respose) {
							if (respose == 200) {
								swal("Done!", "Book deleted Sucessfully", "success");
								$("#example").load(location.href + " #example")
							} else if (respose == 500) {
								swal("Error!", "Something went Wrong", "error");

							} else {
								swal("Error!", "Book not deleted Sucessfully", "error");
							}
						}
					});
				}
			});
	}

	function deleteCategory(id) {
		var id = id;
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: "delCategory.php",
						type: "post",
						data: {
							'delid': id,
						},
						success: async function(respose) {
							if (respose == 200) {
								await swal("Done!", "Category deleted Sucessfully", "success");
								await location.reload();
							} else if (respose == 500) {
								swal("Error!", "Something went Wrong", "error");
							} else {
								swal("Error!", "Category not deleted Sucessfully", "error");
							}
						}
					});
				}
			});
	}

	function deleteUser(id) {
		var id = id;
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: "delUser.php",
						type: "post",
						data: {
							'delid': id,
						},
						success: async function(respose) {
							if (respose == 200) {
								await swal("Done!", "User deleted Sucessfully", "success");
								await location.reload();
							} else if (respose == 500) {
								swal("Error!", "Something went Wrong", "error");
							} else {
								swal("Error!", "User not deleted Sucessfully", "error");
							}
						}
					});
				}
			});
	}

	function deleteMessage(id) {
		var id = id;
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: "delMessage.php",
						type: "post",
						data: {
							'mid': id,
						},
						success: async function(respose) {
							if (respose == 200) {
								await swal("Done!", "User deleted Sucessfully", "success");
								await location.reload();
							} else if (respose == 500) {
								swal("Error!", "Something went Wrong", "error");
							} else {
								swal("Error!", "User not deleted Sucessfully", "error");
							}
						}
					});
				}
			});
	}
	// for user
</script>