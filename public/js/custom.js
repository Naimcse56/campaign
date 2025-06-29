
const deleteData = function (title, route, id) {
    Swal.fire({
        title: "Are you sure?",
        text: "Want to delete this " + title,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3852cd",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success",
                        text: title + " Deleted",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });
};
const approveData = function (title, route, id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to approve " + title,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3852cd",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve It!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success",
                        text: title + " Approved",
                        icon: "success"
                    }).then((result) => {
                        // Check if the user clicked "OK"
                        if (result.isConfirmed) {
                            // Reload the page
                            location.reload();
                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });
};

const approveMultipleItemData = function (title, route, approval) {
    var selectedLanguage = new Array();
    var rejectNote = new Array();
    if (approval == "reject" || approval == "query") {
        $('input[name="ids"]:checked').each(function () {
            selectedLanguage.push(this.value);
            rejectNote.push($('.' + this.value + '_comment').val());
            console.log($('.' + this.value + '_comment').val());
        });
    } else {
        $('input[name="ids"]:checked').each(function () {
            selectedLanguage.push(this.value);
        });
    }
    if (selectedLanguage.length > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to " + approval + " " + title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3852cd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        _token: APP_TOKEN,
                        id: selectedLanguage,
                        rejection_comment: rejectNote,
                        approval: approval,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: title + " Approved",
                            icon: "success"
                        }).then((result) => {
                            // Check if the user clicked "OK"
                            if (result.isConfirmed) {
                                // Reload the page
                                location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }
        });
    } else {
        toastr.error('Select Minimum One Item First!');
    }
};

