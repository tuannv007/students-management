<script type="text/javascript">
    $(document).ready(function() {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };

        function fetchClasses(input) {
            window.location.href = window.CI.baseUrl + 'admin/students/edit/<?php echo $student['id'] ?>' + '?' + $.param(input);
        }

        var input = {
            department_id: getUrlParameter('department_id'),
            school_year_id: getUrlParameter('school_year_id')
        };

        $('[name="school_year_id"]').change(function () {
            input.school_year_id = $(this).val();
            fetchClasses(input);
        });

        $('[name="department_id"]').change(function () {
            input.department_id = $(this).val();
            fetchClasses(input);
        });
    });

</script>
