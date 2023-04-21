function formInput(selector) {
    console.log(selector);
    $(selector).append(
        `<div class="col-6 col-lg-3 pt-2 pt-lg-4">
                <input type="file" class="form-control" name="file[]" />
            </div>
        </div>`
   );
}

export default {
    formInput,
}