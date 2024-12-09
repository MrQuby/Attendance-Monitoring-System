$(document).ready(function () {
    $('.btn-primary[data-bs-target="#editCourseModal"]').on('click', function () {
        var courseId = $(this).data('course-id');
        var courseName = $(this).data('course-name');
        var courseDescription = $(this).data('course-description');

        $('#editCourseId').val(courseId);
        $('#editCourseName').val(courseName);
        $('#editCourseDescription').val(courseDescription);
    });

    // Course delete modal functionality
    $('.btn-danger[data-bs-target="#deleteCourseModal"]').on('click', function () {
        var courseId = $(this).data('course-id');
        $('#deleteCourseId').val(courseId);
    });
});