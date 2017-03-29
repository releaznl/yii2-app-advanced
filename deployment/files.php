<?php
namespace Deployer;

task('files', [
  'upload_files'
]);

task('upload_files', function()
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
        writeln("<error> Can't find file: {{$file}} </error>");
        return false;
    }

    return true;
}

function upload_file($file)
{
    upload($file, "{{release_path}}/" . $file);
}
