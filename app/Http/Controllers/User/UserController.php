<?php

namespace App\Http\Controllers\User;

use App\Models\UserProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Reference;
use App\Models\SocialLink;
use App\Models\HobbyTranslation;
use App\Models\UserTemplateSetting;
use App\Models\Language;
use App\Models\Template;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UserController extends Controller


{
    // dashboard
    public function dashboard()
    {
        return view('user.dashboard');
    }
    // cvs
    public function cvs(){
        return view('user.pages.cvs');
    }

    // newCvs
    public function newCvs(){
        return view('user.pages.newCvs');
    }

    // cvDesign
    public function cvDesign(){
        $templates = Template::where('template_name', 'cvDesign-cv-one')->first();
        // dd($templates);
        return view('user.pages.cvDesign' , compact('templates'));
    }

    // cvDesign-cv-one
    public function cvDesignCvOne(){
        $user_id = Auth::id();
        $userTemplateSetting = UserTemplateSetting::where('user_id',  $user_id)->first();

        $userProfile = UserProfile::orderBy('id', 'DESC')->get();
        $educations = Education::orderBy('id', 'DESC')->get();
        $experiences = Experience::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $skills = Skill::orderBy('id', 'DESC')->get();
        $references = Reference::orderBy('id', 'DESC')->get();
        $socialLinks = SocialLink::orderBy('id', 'DESC')->get();
        $hobbyTranslations = HobbyTranslation::orderBy('id', 'DESC')->get();
        return view('user.pages.cvDesign-cv-one', compact('userProfile', 'educations', 'experiences', 'projects' , 'skills' , 'references' , 'socialLinks' , 'hobbyTranslations' , 'userTemplateSetting'));
    }

    // cvDesign-cv-two
    public function cvDesignCvTwo(){

        $user_id = Auth::id();
        $userTemplateSetting = UserTemplateSetting::where('user_id',  $user_id)->first();
        // dd($userTemplateSetting);

        $userProfile = UserProfile::orderBy('id', 'DESC')->get();
        $educations = Education::orderBy('id', 'DESC')->get();
        $experiences = Experience::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $skills = Skill::orderBy('id', 'DESC')->get();
        $references = Reference::orderBy('id', 'DESC')->get();
        $socialLinks = SocialLink::orderBy('id', 'DESC')->get();
        $hobbyTranslations = HobbyTranslation::orderBy('id', 'DESC')->get();
        return view('user.pages.cvDesign-cv-two', compact('userProfile', 'educations', 'experiences', 'projects' , 'skills' , 'references' , 'socialLinks' , 'hobbyTranslations' , 'userTemplateSetting'));
    }

    // cvDesign-cv-three
    public function cvDesignCvThree(){
        $user_id = Auth::id();
        $userTemplateSetting = UserTemplateSetting::where('user_id',  $user_id)->first();


        $userProfile = UserProfile::orderBy('id', 'DESC')->get();
        $educations = Education::orderBy('id', 'DESC')->get();
        $experiences = Experience::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $skills = Skill::orderBy('id', 'DESC')->get();
        $references = Reference::orderBy('id', 'DESC')->get();
        $socialLinks = SocialLink::orderBy('id', 'DESC')->get();
        $hobbyTranslations = HobbyTranslation::orderBy('id', 'DESC')->get();
        return view('user.pages.cvDesign-cv-three', compact('userProfile', 'educations', 'experiences', 'projects' , 'skills' , 'references' , 'socialLinks' , 'hobbyTranslations' , 'userTemplateSetting'));

    }

    // cvDesign-cv-four
    public function cvDesignCvFour(){
        $user_id = Auth::id();
        $userTemplateSetting = UserTemplateSetting::where('user_id',  $user_id)->first();

        $userProfile = UserProfile::orderBy('id', 'DESC')->get();
        $educations = Education::orderBy('id', 'DESC')->get();
        $experiences = Experience::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $skills = Skill::orderBy('id', 'DESC')->get();
        $references = Reference::orderBy('id', 'DESC')->get();
        $socialLinks = SocialLink::orderBy('id', 'DESC')->get();
        $hobbyTranslations = HobbyTranslation::orderBy('id', 'DESC')->get();
        return view('user.pages.cvDesign-cv-four', compact('userProfile', 'educations', 'experiences', 'projects' , 'skills' , 'references' , 'socialLinks' , 'hobbyTranslations' , 'userTemplateSetting' ));

    }

    // cvDesign-cv-five
    public function cvDesignCvFive(){

        $user_id = Auth::id();
        $userTemplateSetting = UserTemplateSetting::where('user_id',  $user_id)->first();

        $userProfile = UserProfile::orderBy('id', 'DESC')->get();
        $educations = Education::orderBy('id', 'DESC')->get();
        $experiences = Experience::orderBy('id', 'asc')->get();
        $projects = Project::orderBy('id',  'asc')->get();
        $skills = Skill::orderBy('id', 'DESC')->get();
        $references = Reference::orderBy('id', 'DESC')->get();
        $socialLinks = SocialLink::orderBy('id', 'DESC')->get();
        $hobbyTranslations = HobbyTranslation::orderBy('id', 'DESC')->get();
        $languages = Language::orderBy('id', 'DESC')->get();

        return view('user.pages.cvDesign-cv-five', compact('userProfile', 'educations', 'experiences', 'projects' , 'skills' , 'references' , 'socialLinks' , 'hobbyTranslations' , 'languages' , 'userTemplateSetting'));
    }

    // cvDownload-share
    public function cvDownloadShare(){
        $templates = Template::orderBy('id', 'DESC')->take(1)->get();
    // dd($templates);
        return view('user.pages.cvDownload-share' , compact('templates'));
    }

    // settings
    public function settings(){

        $userId = Auth::id();
        // استرجاع القالب المرتبط بالمستخدم
    $template = Template::where('user_id', $userId)->first();
    // dd($template);
        return view('user.pages.settings' , compact('template'));
    }


    // editor
    public function editor(){
        $user_id = Auth::id();
        $templates = Template::orderBy('id', 'DESC')->take(1)->get();
        // $Usertemplates = UserTemplateSetting::all();
        $userTemplateSetting = UserTemplateSetting::where('template_name', 'template_1')
        ->where('user_id', $user_id)
        ->first();
        // dd($userTemplateSetting);
        return view('user.pages.editor' , compact('templates', 'userTemplateSetting'));
    }
}
