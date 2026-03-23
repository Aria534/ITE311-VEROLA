<div class="container mt-4">
    <h3 class="mb-3">Search Courses</h3>

<div class="row mb-4">
    <div class="col-md-6">
        <form id="searchForm" class="d-flex">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control"
                    placeholder="Search courses..." name="search_term">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ===================================== -->
<!-- Courses Container -->
<!-- ===================================== -->
<div id="coursesContainer" class="row">
    <?php foreach ($courses as $course): ?>
        <div class="col-md-4 mb-4">
            <div class="card course-card">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($course['course_name']) ?></h5>
                    <p class="card-text"><?= esc($course['description']) ?></p>
                    <a href="<?= site_url("course/view/{$course['id']}") ?>" class="btn btn-primary"></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<!-- ===================================== -->
<!-- jQuery + Search Scripts -->
<!-- ===================================== -->
 
<script>
$(document).ready(function() {

    // Client-side filtering
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase()
        $('.course-card').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Server-side search with AJAX
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#searchInput').val();

        $.get('/courses/search', {search_term: searchTerm}, function(data) {
            $('#coursesContainer').empty();

            if (data.course&&data.course.length > 0) {
                $.each(data.course, function(index, course) {
                    var courseHtml = `
                        <div class="col-md-4 mb-4">
                            <div class="card course-card">
                                <div class="card-body">
                                    <h5 class="card-title">${course.course_name}</h5>
                                    <p class="card-text">${course.course_description}</p>
                                    <a href="/courses/view/${course.id}" class="btn btn-primary">View Course</a>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#coursesContainer').append(courseHtml);
                });
            } else {
                $('#coursesContainer').html('<div class="col-12"><div class="alert alert-info">No courses found matching your search.</div></div>');
            }
        });
    });

});

