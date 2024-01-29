<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Member;

trait TransformsMembers
{
    /**
     * @param array $members
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Member[]
     */
    protected function fromClickupMembers($members): array
    {
        Validator::isArray($members);

        return array_map(function ($member) {
            return $this->fromClickupMember($member);
        }, $members);
    }

    /**
     * @param array $member
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Member
     */
    protected function fromClickupMember($member): Member
    {
        Validator::keysExists($member, ['id', 'username']);

        return new Member([
            'id' => $member['id'],
            'username' => $member['username'],
            'email' => $member['email'],
            'avatarUrl' => $member['profilePicture'],
        ]);
    }
}
