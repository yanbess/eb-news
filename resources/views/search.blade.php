<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        body {
            margin-top: 60px;
        }
    </style>
</head>
<body class="antialiased">
<div class="container">
    <form method="get">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-9">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search news here..."
                           aria-label="Search news here..." aria-describedby="button-addon2" name="form[query]"
                           value="{{ $form['query'] ?? '' }}">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="language" class="form-label">Language:</label>
                                <select class="form-select" aria-label="Language" name="form[language]" id="language">
                                    @foreach (['' => 'All', 'de' => 'German', 'es' => 'Spanish', 'fr' => 'French'] as $key => $item)
                                        <option value="{{ $key }}"
                                                {{ isset($form['language']) && $form['language'] === $key ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="daterange" class="form-label">Date range:</label>
                                <input type="text" class="form-control" id="daterange" name="form[daterange]">
                            </div>
                            <div class="mb-3">
                                <label for="sorting" class="form-label">Sorting:</label>
                                <select class="form-select" aria-label="Sorting" id="sorting" name="form[sorting]">
                                    <option value="asc"
                                    {{ isset($form['sorting']) && $form['sorting'] === 'asc' ? 'selected' : '' }}>Ascending</option>
                                    <option value="desc"
                                    {{ isset($form['sorting']) && $form['sorting'] === 'desc' ? 'selected' : '' }}>Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title:</th>
                        <th scope="col">Language:</th>
                        <th scope="col">Published date:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($news->data->news))
                        @foreach ($news->data->news as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->language }}</td>
                                <td>{{ date('d.m.Y', strtotime($item->publishedDate)) }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                @if (empty($news->data->news))
                    <div class="text-center w-100 mt-5">Nothing found...</div>
                @endif
            </div>
        </div>
    </form>
</div>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    let DROptions = {
        locale: {
            format: 'DD.MM.Y'
        }
    };

    @if (isset($form['daterange']['from']))
        DROptions.startDate = '{{ $form['daterange']['from'] }}';
    @endif

    @if (isset($form['daterange']['to']))
        DROptions.endDate = '{{ $form['daterange']['to'] }}';
    @endif

    $(function () {
        $('#daterange').daterangepicker(DROptions);
    });
</script>
</html>
