<?php

namespace App\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;
use LdapRecord\Models\ActiveDirectory\Group;

class OnlyEliteCompany implements Rule
{
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, Eloquent $model = null): bool
    {
        // Define required group DNs in an associative array for quick lookup
        $requiredGroup = 'cn=elite,cn=groups,cn=accounts,dc=demo1,dc=freeipa,dc=org';
        $userGroupDNs = $user->memberof;

        // Check if all required groups are in the user's group list
        $isMemberOfAllRequiredGroups = $this->isMemberOfRequiredGroups($userGroupDNs, $requiredGroup);

        return $isMemberOfAllRequiredGroups;
    }

    /**
     * Helper function to check if user is a member of all required groups.
     */
    private function isMemberOfRequiredGroups(array $userGroups, string $requiredGroup): bool
    {
        foreach ($userGroups as $group) {
            if ($group === $requiredGroup) {
                return true;
            }
        }

        return false;
    }
}
