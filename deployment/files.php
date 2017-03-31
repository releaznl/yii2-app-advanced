<?php
namespace Deployer;

desc("Perform all the files tasks");
task('files', [
  'files:upload_files',
  'files:show'
]);

desc("Uploads all the files that where given in the upload tag.");
task('files:upload_files', function()
{
    $files = get('settings')['files']['upload_files'];
    if($files)
    {
        foreach($files as $file)
        {
            if(check_file($file))
            {
                upload_file($file);
            }
        }
    }
});

desc("Shows files that where given in the show tag.");
task('files:show', function()
{
    $shows = get('settings')['files']['show'];
    if($shows)
    {
        foreach($shows as $file)
        {
            if(check_file_remote($file))
            {
                show_file_remote($file);
            }
        }
    }
});

function check_file($file)
{
    if(!file_exists($file))
    {
        writeln("<error> Can't find file: {{$file}} ... But continue! </error>");
        return false;
    }

    return true;
}

function check_file_remote($file)
{
    $response = run("if [ -f {{release_path}}/{$file} ]; then echo 'true'; fi");
    $status = $response->toBool();
    if(!$status)
    {
        writeln("<error>Can't find file: {{release_path}}/{$file} ... But continue!</error>");
    }
    return $status;
}

function show_file_remote($file)
{
    $remote_file = "{{release_path}}" . "/" . $file;
    writeln("<comment>Showing: {$remote_file}</comment>");
    run("cat " . $remote_file);
}

function upload_file($file)
{
    upload($file, "{{release_path}}/" . $file);
}
