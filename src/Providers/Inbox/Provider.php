<?php

namespace Wetcat\Fortie\Providers\Inbox;

/*

   Copyright The Fortie authors

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

*/

use Wetcat\Fortie\FortieRequest;
use Wetcat\Fortie\Providers\ProviderBase;

class Provider extends ProviderBase
{
    protected $attributes_file = [
        'Url',
        'Comments',
        'Id',
        'Name',
        'Path',
        'Size',
    ];

    protected $writeable_file = [
    ];

    protected $required_create_file = [
    ];

    protected $required_update_file = [
    ];

    protected $attributes_folder = [
        'Url',
        'Email',
        'Files',
        'Folders',
        'Id',
        'Name',
    ];

    protected $writeable_folder = [
        // 'Url',
        // 'Email',
        // 'Files',
        // 'Folders',
        // 'Id',
        'Name',
    ];

    protected $required_create_folder = [
    ];

    protected $required_update_folder = [
    ];

    /**
     * Override the REST path.
     */
    protected $basePath = 'inbox';

    /**
     * Retrieves a list of files and folders.
     *
     * @param null|mixed $page
     *
     * @return array
     */
    public function all($page = null)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath);

        if (! is_null($page)) {
            $req->param('page', $page);
        }

        return $this->send($req->build());
    }

    /**
     * Retrieves a single file or folder.
     *
     * @param $id
     *
     * @return array
     */
    public function find($id)
    {
        $req = new FortieRequest();
        $req->method('GET');
        $req->path($this->basePath)->path($id);

        return $this->send($req->build());
    }

    /**
     * Upload a file to a specific subdirectory.
     *
     * @param $folderId
     * @param $filePath
     *
     * @return array
     */
    public function upload($folderId, $filePath)
    {
        $req = new FortieRequest();
        $req->method('POST');
        $req->path($this->basePath);
        $req->params(['folderid' => $folderId]);
        $req->filePath($filePath);

        return $this->send($req->build());
    }

    /**
     * Upload a file to a specific path.
     *
     * @param $folderId
     * @param $filePath
     * @param mixed $path
     *
     * @return array
     */
    public function uploadPath($path, $filePath)
    {
        $req = new FortieRequest();
        $req->method('POST');
        $req->path($this->basePath);
        $req->params(['path' => $path]);
        $req->filePath($filePath);

        return $this->send($req->build());
    }

    /**
     * Removes a file or folder.
     *
     * @param array $data
     * @param mixed $folderId
     *
     * @return array
     */
    public function delete($folderId)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath)->path($folderId);

        return $this->send($req->build());
    }

    /**
     * Removes a file or folder.
     *
     * @param array $data
     * @param mixed $path
     *
     * @return array
     */
    public function deletePath($path)
    {
        $req = new FortieRequest();
        $req->method('DELETE');
        $req->path($this->basePath);
        $req->params(['path' => $path]);

        return $this->send($req->build());
    }
}
