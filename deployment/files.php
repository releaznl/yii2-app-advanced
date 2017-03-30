<?php
namespace Deployer;

desc("Perform all the files tasks");
task('files', [
  'upload_files'
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

function check_file($file)
{
    if(!file_exists($file))
    {
        writeln("<error> Can't find file: {{$file}} ... But continue! </error>");
        return false;
    }

    return true;
}

function upload_file($file)
{
    upload($file, "{{release_path}}/" . $file);
}
