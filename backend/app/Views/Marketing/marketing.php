<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-2">
        <div class="card">
            <button id="allButton" type="button" class="btn btn-primary">All</button>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <button id="last30Button" type="button" class="btn btn-primary">Last 30 Days</button>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <button type="button" class="btn btn-primary">Cancel</button>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <button type="button" class="btn btn-primary">Primary</button>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <button type="button" class="btn btn-primary">History</button>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <button type="button" class="btn btn-primary">Primary</button>
        </div>
    </div>
</div>

<form id="emailForm">
    <div class="my-2">
        <label for="basiInput" class="form-label">Title</label>
        <input type="text" class="form-control" id="to" name="to">
    </div>
    <div class="my-2">
        <label for="basiInput" class="form-label">Title</label>
        <input type="text" class="form-control" id="basiInput" name="title">
    </div>
    <div class="my-2">
        <label for="basiInput" class="form-label">Message</label>
        <input type="text" class="form-control" id="basiInput" name="message">
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>
<script src="/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="/assets/js/pages/form-editor.init.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const allButton = document.getElementById('allButton');
    const last30Button = document.getElementById('last30Button');

    allButton.addEventListener('click', function() {
        allButton.classList.add('btn-success');
        last30Button.classList.remove('btn-success');
        setSelectedFilterAndFetchData('all');
    });

    last30Button.addEventListener('click', function() {
        last30Button.classList.add('btn-success');
        allButton.classList.remove('btn-success');
        setSelectedFilterAndFetchData('last30');
    });

    function setSelectedFilterAndFetchData(filter) {
        alert(filter);
        fetch('/set_selected_filter/' + filter)
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                console.log('Users:', data.users);

                if (data.users && data.users.length > 0) {
                    const emails = data.users.map(user => user.email).join('; ');
                    document.getElementById('to').value = emails;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.getElementById('emailForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert("hii")
        const form = new FormData(this);
        fetch('send_email', {
                method: 'POST',
                body: form
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Email sent successfully') {
                    console.log(data.message);
                } else {
                    console.error('Error sending email:', data.error_data);
                    console.log('Error Info:', data.error_info);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

<script src="/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="/assets/js/pages/form-editor.init.js"></script>
<script src="/assets/js/app.js"></script>
<?= $this->endSection() ?>