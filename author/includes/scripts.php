<!-- datatable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- sweet alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- datatable -->
<script>
	$(document).ready(function() {
		var t1 = $('#example').DataTable();

		t1.on('order.dt search.dt', function() {
			let i = 1;
			t1.cells(null, 0, {
				order: 'applied'
			}).every(function(cell) {
				this.data(i++);
			});
		}).draw();
		var t = $('#acategory').DataTable({
			columnDefs: [{
				searchable: false,
				orderable: false,
				targets: 0,
			}, ],
		});

		t.on('order.dt search.dt', function() {
			let i = 1;

			t.cells(null, 0, {
				search: 'applied',
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
					swal("Done!", "Book is Approved", "success");
				} else {
					swal("Done!", "Book is Disapproved", "success");
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
							// 'confirm_btn':true
						},
						success: function(respose) {
							if (respose == 200) {
								swal("Done!", "Book deleted Sucessfully", "success");
								$("#example").load(location.href + " #example")
							} else if (respose == 500) {
								swal("Error!", "Something went Wrong", "error");

							} else {
								swal("Error!", "Product not deleted Sucessfully", "error");
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
</script>