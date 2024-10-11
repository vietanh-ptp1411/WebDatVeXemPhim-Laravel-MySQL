$(document).ready(function() {
    // Tạo danh sách tỉnh/thành phố
    var provincesHtml = '<option value="">Tỉnh / Thành phố</option>';
    c.forEach(function(province, index) {
        provincesHtml += '<option value="' + (index + 1) + '">' + province + '</option>';
    });
    $('select[name="calc_shipping_provinces"]').html(provincesHtml);

    // Nếu đã lưu tỉnh/thành phố trước đó, chọn tỉnh/thành phố đó
    var savedProvince = localStorage.getItem('address_1_saved');
    if (savedProvince) {
        $('select[name="calc_shipping_provinces"] option').each(function() {
            if ($(this).text() == savedProvince) {
                $(this).attr('selected', '');
            }
        });
        $('input.billing_address_1').attr('value', savedProvince);
    }

    // Xử lý sự kiện khi chọn tỉnh/thành phố
    $('select[name="calc_shipping_provinces"]').on('change', function() {
        var selectedProvinceIndex = $(this).val() - 1;
        var districtsHtml = '<option value="">Quận / Huyện</option>';
        if (selectedProvinceIndex >= 0) {
            arr[selectedProvinceIndex].forEach(function(district) {
                districtsHtml += '<option value="' + district + '">' + district + '</option>';
            });
        }
        $('select[name="calc_shipping_district"]').html(districtsHtml);

        // Lưu tỉnh/thành phố được chọn
        var selectedProvinceText = $(this).children('option:selected').text();
        localStorage.setItem('address_1_saved', selectedProvinceText);
    });

    // Nếu đã lưu quận/huyện trước đó, chọn quận/huyện đó
    var savedDistrict = localStorage.getItem('address_2_saved');
    if (savedDistrict) {
        $('select[name="calc_shipping_district"] option').each(function() {
            if ($(this).text() == savedDistrict) {
                $(this).attr('selected', '');
            }
        });
        $('input.billing_address_2').attr('value', savedDistrict);
    }

    // Xử lý sự kiện khi chọn quận/huyện
    $('select[name="calc_shipping_district"]').on('change', function() {
        var selectedDistrict = $(this).children('option:selected').text();
        $('input.billing_address_2').attr('value', selectedDistrict);

        // Lưu quận/huyện được chọn
        localStorage.setItem('address_2_saved', selectedDistrict);
    });
});