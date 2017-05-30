<?php

namespace UnaGauchada\SecurityBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use UnaGauchada\PublicationBundle\Entity\Publication;
use UnaGauchada\UserBundle\Entity\User;

class PublicationVoter extends Voter
{
// these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const SUBMIT = 'submit';
    const UNSUBMIT = 'unsubmit';
    const COMMENT = 'comment';

    protected function supports($attribute, $subject)
    {
// if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::SUBMIT, self::UNSUBMIT, self::COMMENT))) {
            return false;
        }

// only vote on Post objects inside this voter
        if (!$subject instanceof Publication) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
// the user must be logged in; if not, deny access
            return false;
        }

// you know $subject is a Post object, thanks to supports
        /** @var Publication $post */
        $publication = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($publication, $user);
            case self::EDIT:
                return $this->canEdit($publication, $user);
            case self::SUBMIT:
                return $this->canSubmit($publication, $user);
            case self::UNSUBMIT:
                return $this->canUnsubmit($publication, $user);
            case self::COMMENT:
                return $this->canComment($publication, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Publication $publication, User $user)
    {
// if they can edit, they can view
        if ($this->canEdit($publication, $user)) {
            return true;
        }

// the Post object could have, for example, a method isPrivate()
// that checks a boolean $private property
        return !$publication->isPrivate();
    }

    private function canEdit(Publication $publication, User $user)
    {
// this assumes that the data object has a getOwner() method
// to get the entity of the user who owns this data object
        return $user === $publication->getUser();
    }

    private function canSubmit(Publication $publication, User $user)
    {
        return !($user->hasSubmission($publication) || $user === $publication->getUser() || $user->isAdmin());
    }

    private function canComment(Publication $publication, User $user)
    {
        return !($user === $publication->getUser() || $user->isAdmin());
    }

    private function canUnsubmit(Publication $publication, User $user)
    {
        return $user->hasSubmission($publication);
    }

}