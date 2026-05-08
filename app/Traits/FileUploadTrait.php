<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

trait FileUploadTrait
{
    /**
     * Upload a file to the specified directory.
     *
     * @param  $file The file to upload
     * @param  string $directory The directory to upload to
     * @param  string $prefix File name prefix
     * @return string The path to the uploaded file
     */
    protected function uploadFile($file, $directory, $prefix = '')
    {
        // Get file extension
        $extension = $file->getClientOriginalExtension();

        // Generate unique filename with prefix
        $filename = $prefix . time() . '_' . uniqid() . '.' . $extension;

        // Move file to destination directory
        $file->move(public_path($directory), $filename);

        // Return the relative path
        return $directory . $filename;
    }

    /**
     * Delete a file from the filesystem.
     *
     * @param  string $filePath The relative path to the file to delete
     * @return bool True if file was deleted successfully, false otherwise
     */
    protected function deleteFile($filePath)
    {
        // Check if file path is provided and not empty
        if (empty($filePath)) {
            return false;
        }

        // Get the full path to the file
        $fullPath = public_path($filePath);

        // Check if file exists and delete it
        if (File::exists($fullPath)) {
            try {
                return File::delete($fullPath);
            } catch (\Exception $e) {
                // Log the error if deletion fails
                Log::error('File deletion failed: ' . $e->getMessage(), [
                    'file_path' => $filePath,
                    'full_path' => $fullPath
                ]);
                return false;
            }
        }

        // File doesn't exist, consider it "successfully deleted"
        return true;
    }

    /**
     * Delete multiple files from the filesystem.
     *
     * @param  array $filePaths Array of relative file paths to delete
     * @return array Array with 'success' count and 'failed' array
     */
    protected function deleteFiles(array $filePaths)
    {
        $successCount = 0;
        $failedFiles  = [];

        foreach ($filePaths as $filePath) {
            if (!$this->deleteFile($filePath)) {
                $failedFiles[] = $filePath;
            } else {
                $successCount++;
            }
        }

        return [
            'success' => $successCount,
            'failed'  => $failedFiles
        ];
    }
}
